<?php

namespace Feedify\BaseBundle\Connection;

use Doctrine\DBAL\Portability\Connection;

/**
 * Class ConnectionWrapper
 * @package Feedify\BaseBundle\Connection
 */
class ConnectionWrapper extends Connection
{
    private $dbname  = 'fd_referenz';

    /** @var bool */
    private $_isConnected = false;

    /**
     * @param string $dbName
     */
    public function forceSwitch($dbName)
    {
        $this->dbname = $dbName;

        if ($this->isConnected()) {
            $this->close();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function connect()
    {
        $params = $this->getParams();
        $params['dbname'] = $this->dbname;
        $this->_conn = $this->_driver->connect($params, $params['user'], $params['password']);

        $this->_isConnected = true;

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function isConnected()
    {
        return $this->_isConnected;
    }

    /**
     * {@inheritDoc}
     */
    public function close()
    {
        if ($this->isConnected()) {
            parent::close();
            $this->_isConnected = false;
        }
    }
}
