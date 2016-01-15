<?php

namespace Feedify\BaseBundle\Entity\Management;

use Symfony\Component\Security\Core\User\UserInterface;
use Feedify\BaseBundle\Constant\UserShop as UserShopConstant;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_shop")
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\UserShopRepository")
 */
class UserShop implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $userid;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $salt;

    /**
     * @ORM\Column(type="string")
     */
    private $role;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="string")
     */
    private $secret;

    /**
     * @ORM\Column(type="string")
     */
    private $bridgeUrl;

    /**
     * @ORM\Column(type="json_array")
     */
    private $urlParams;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="json_array")
     */
    private $possibleConfig;

    /**
     * @ORM\Column(type="json_array")
     */
    private $actualConfig;

    /**
     * @ORM\Column(type="json_array")
     */
    private $possibleFields;

    /**
     * @ORM\Column(type="json_array")
     */
    private $actualFields;

    /**
     * @ORM\Column(name="shop_name", type="string", nullable=true)
     */
    private $shopName;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->salt = md5(uniqid(null, true));
        $this->role = UserShopConstant::API_USER;
        $this->active = 0;
        $this->secret = '';
        $this->bridgeUrl = '';
        $this->urlParams = array();
        $this->title = '';
        $this->possibleConfig = array();
        $this->actualConfig = array();
        $this->possibleFields = array();
        $this->actualFields = array();
    }

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
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->id;
    }

    /**
     * Set userid
     *
     * @param integer $userid
     * @return UserShop
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    
        return $this;
    }

    /**
     * Get userid
     *
     * @return integer
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return UserShop
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return UserShop
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return UserShop
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a `roles` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return array The user roles
     */
    public function getRoles()
    {
        return array($this->role);
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return UserShop
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set secret
     *
     * @param string $secret
     * @return UserShop
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    
        return $this;
    }

    /**
     * Get secret
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Set bridgeUrl
     *
     * @param string $bridgeUrl
     * @return UserShop
     */
    public function setBridgeUrl($bridgeUrl)
    {
        $this->bridgeUrl = $bridgeUrl;
    
        return $this;
    }

    /**
     * Get bridgeUrl
     *
     * @return string
     */
    public function getBridgeUrl()
    {
        return $this->bridgeUrl;
    }

    /**
     * Set urlParams
     *
     * @param string $urlParams
     * @return UserShop
     */
    public function setUrlParams($urlParams)
    {
        $this->urlParams = $urlParams;

        return $this;
    }

    /**
     * Get urlParams
     *
     * @return string
     */
    public function getUrlParams()
    {
        return $this->urlParams;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return UserShop
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set possibleConfig
     *
     * @param array $possibleConfig
     * @return UserShop
     */
    public function setPossibleConfig($possibleConfig)
    {
        $this->possibleConfig = $possibleConfig;

        return $this;
    }

    /**
     * Get possibleConfig
     *
     * @return array
     */
    public function getPossibleConfig()
    {
        return $this->possibleConfig;
    }

    /**
     * Set actualConfig
     *
     * @param array $actualConfig
     * @return UserShop
     */
    public function setActualConfig($actualConfig)
    {
        $this->actualConfig = $actualConfig;

        return $this;
    }

    /**
     * Get actualConfig
     *
     * @return array
     */
    public function getActualConfig()
    {
        return $this->actualConfig;
    }

    /**
     * Set possibleFields
     *
     * @param array $possibleFields
     * @return UserShop
     */
    public function setPossibleFields($possibleFields)
    {
        $this->possibleFields = $possibleFields;

        return $this;
    }

    /**
     * Get possibleFields
     *
     * @return array
     */
    public function getPossibleFields()
    {
        return $this->possibleFields;
    }

    /**
     * Set actualFields
     *
     * @param array $actualFields
     * @return UserShop
     */
    public function setActualFields($actualFields)
    {
        $this->actualFields = $actualFields;

        return $this;
    }

    /**
     * Get actualFields
     *
     * @return array
     */
    public function getActualFields()
    {
        return $this->actualFields;
    }

    /**
     * Set shopName
     *
     * @param string $shopName
     * @return UserShop
     */
    public function setShopName($shopName)
    {
        $this->shopName = $shopName;

        return $this;
    }

    /**
     * Get shopName
     *
     * @return string
     */
    public function getShopName()
    {
        return $this->shopName;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     *
     * @return void
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize($this->id);
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     */
    public function unserialize($serialized)
    {
        $this->id = unserialize($serialized);
    }
}
