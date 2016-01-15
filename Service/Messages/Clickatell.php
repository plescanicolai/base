<?php

namespace Feedify\BaseBundle\Service\Messages;

use Lexik\Bundle\TranslationBundle\Translation\Translator;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class Clickatell
 * @package Feedify\BaseBundle\Service\Messages
 */
class Clickatell
{
    /** @var Logger */
    protected $log;

    /**
     * @param Translator $translator
     * @param string     $user
     * @param string     $password
     * @param string     $apiId
     * @param string     $baseUrl
     * @param string     $rootDir
     */
    public function __construct($translator, $user, $password, $apiId, $baseUrl, $rootDir)
    {
        $this->translator = $translator;
        $this->user = $user;
        $this->password = $password;
        $this->apiId = $apiId;
        $this->baseUrl = $baseUrl;
        $this->rootDir = $rootDir;
    }

    /**
     * @param null $securityCode
     * @param null $mobile
     * @param null $username
     * @return bool
     */
    public function sendSmsMessage($securityCode = null, $mobile = null, $username = null)
    {
        $this->initMessagesLog();
        $this->log->addInfo('SENDING message to.... ', ['username' => $username, 'mobile' => $mobile]);
        if (!$securityCode || !$mobile) {
            $this->log->addError(
                'No security code or mobile number found: ',
                ['mobile' => $mobile, 'securityCode' => $securityCode]
            );

            return false;
        }

        $text = urlencode($securityCode);
        $to = $mobile;

        // auth call
        $url = "$this->baseUrl/http/auth?user=$this->user&password=$this->password&api_id=$this->apiId";

        // do auth call
        $ret = file($url);

        // explode our response. return string is on first line of the data returned
        $response = explode(":", $ret[0]);
        if ($response[0] == "OK") {
            $responseId = trim($response[1]); // remove any whitespace
            $url = "$this->baseUrl/http/sendmsg?session_id=$responseId&to=$to&text=$text";

            // do sendmsg call
            $ret = file($url);
            $send = explode(":", $ret[0]);

            if ($send[0] == "ID") {
                $this->log->addInfo("successnmessage ID: ".$send[1]);

                return 1;
            } else {
                $this->log->addError(
                    'Send message failed',
                    ['mobile' => $mobile, 'securityCode' => $securityCode, 'return' => $send]
                );

                return 2;
            }
        } else {
//            print 'sc: '.$securityCode.'  ';
            $this->log->addError('Authentication failure: ', ['returned' => $ret[0], 'url' => $url]);

            return 0;
        }
    }

    /**
     * Create a log channel to ClickATell actions
     *
     * @return Logger
     */
    protected function initMessagesLog()
    {
        if (!$this->log) {
            $this->log = new Logger('messages');
            $this->log->pushHandler(new StreamHandler($this->rootDir.'/logs/clickatell.log', Logger::INFO));
        }

        return $this->log;
    }
}
