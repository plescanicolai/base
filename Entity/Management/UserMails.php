<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserMails
 *
 * @ORM\Table(name="user_mails")
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\UserMailsRepository")
 */
class UserMails
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=true)
     */
    private $username;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="at_date", type="datetime")
     */
    private $atDate;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_key", type="string", length=255)
     */
    private $mailKey;

    /**
     * @var string
     *
     * @ORM\Column(name="mail_value", type="json_array")
     */
    private $mailValue;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return UserMails
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set mailKey
     *
     * @param string $mailKey
     * @return UserMails
     */
    public function setMailKey($mailKey)
    {
        $this->mailKey = $mailKey;

        return $this;
    }

    /**
     * Get mailKey
     *
     * @return string
     */
    public function getMailKey()
    {
        return $this->mailKey;
    }

    /**
     * Set mailValue
     *
     * @param string $mailValue
     * @return UserMails
     */
    public function setMailValue($mailValue)
    {
        $this->mailValue = $mailValue;

        return $this;
    }

    /**
     * Get mailValue
     *
     * @return string
     */
    public function getMailValue()
    {
        return $this->mailValue;
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function setAtDate($date)
    {
        $this->atDate = $date;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAtDate()
    {
        return $this->atDate;
    }
}
