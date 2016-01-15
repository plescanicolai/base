<?php

namespace Feedify\BaseBundle\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="configuration")
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Customer\ConfigRepository")
 */
class Config
{
    /**
     * @var integer
     *
     * @ORM\Column(name="configuration_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="configuration_title", type="string", nullable=true, length=64)
     */
    private $configurationTitle;

    /**
     * @ORM\Column(name="configuration_key", type="string", length=64)
     */
    private $configurationKey;

    /**
     * @ORM\Column(name="configuration_value", type="json_array")
     */
    private $configurationValue;

    /**
     * @ORM\Column(name="configuration_description", type="string", nullable=true)
     */
    private $configurationDescription;


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
     * Set configurationTitle
     *
     * @param string $configurationTitle
     * @return Config
     */
    public function setConfigurationTitle($configurationTitle)
    {
        $this->configurationTitle = $configurationTitle;
    
        return $this;
    }

    /**
     * Get configurationTitle
     *
     * @return string
     */
    public function getConfigurationTitle()
    {
        return $this->configurationTitle;
    }

    /**
     * Set configurationKey
     *
     * @param string $configurationKey
     * @return Config
     */
    public function setConfigurationKey($configurationKey)
    {
        $this->configurationKey = $configurationKey;
    
        return $this;
    }

    /**
     * Get configurationKey
     *
     * @return string
     */
    public function getConfigurationKey()
    {
        return $this->configurationKey;
    }

    /**
     * Set configurationValue
     *
     * @param array $configurationValue
     * @return Config
     */
    public function setConfigurationValue($configurationValue)
    {
        $this->configurationValue = $configurationValue;
    
        return $this;
    }

    /**
     * Get configurationValue
     *
     * @return array
     */
    public function getConfigurationValue()
    {
        return $this->configurationValue;
    }

    /**
     * Set configurationDescription
     *
     * @param string $configurationDescription
     * @return Config
     */
    public function setConfigurationDescription($configurationDescription = null)
    {
        $this->configurationDescription = $configurationDescription;
    
        return $this;
    }

    /**
     * Get configurationDescription
     *
     * @return null|string
     */
    public function getConfigurationDescription()
    {
        return $this->configurationDescription;
    }
}
