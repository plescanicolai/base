<?php

namespace Feedify\BaseBundle\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Providers
 *
 * @ORM\Table(name="providers")
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Customer\ProvidersRepository")
 */
class Provider
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
     * @var integer
     *
     * @ORM\Column(name="market_id", type="integer", unique=true)
     */
    private $market;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var float
     *
     * @ORM\Column(name="click_price_value", type="float")
     */
    private $clickPriceValue;

    /**
     * @var integer
     *
     * 0 -- cost per click
     * 1 -- percentage

     * @ORM\Column(name="click_price_type", type="integer", nullable=true)
     */
    private $clickPriceType;

    /**
     * @var integer
     *
     * @ORM\Column(name="min_sales_value", type="integer", nullable=true)
     */
    private $minSalesValue;

    /**
     * @var integer
     * 0 -- Unique
     * 1 -- Everymonth
     *
     * @ORM\Column(name="min_sales_type", type="integer", nullable=true)
     */
    private $minSalesType;

    /**
     * @var integer
     *
     * @ORM\Column(name="free_clicks_value", type="integer", nullable=true)
     */
    private $freeClicks;

    /**
     * Possible values :
     *      0   - Unique
     *      1   - Every month
     *
     * @var integer
     *
     * @ORM\Column(name="free_clicks_type", type="integer", nullable=true)
     */
    private $freeClicksType;

    /**
     * @var string
     *
     * @ORM\Column(name="utm_source", type="string", nullable=true)
     */
    private $utmSource;

    /**
     * @var string
     *
     * @ORM\Column(name="utm_medium", type="string", nullable=true)
     */
    private $utmMedium;

    /**
     * @var string
     *
     * @ORM\Column(name="utm_campaign", type="string", nullable=true)
     */
    private $utmCampaign;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $activeSince;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->activeSince = new \DateTime();
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
     * Set market
     *
     * @param integer $market
     * @return Provider
     */
    public function setMarket($market)
    {
        $this->market = $market;

        return $this;
    }

    /**
     * Get market
     *
     * @return integer
     */
    public function getMarket()
    {
        return $this->market;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Provider
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set clickPriceValue
     *
     * @param float $clickPriceValue
     * @return Provider
     */
    public function setClickPriceValue($clickPriceValue)
    {
        $this->clickPriceValue = $clickPriceValue;

        return $this;
    }

    /**
     * Get clickPriceValue
     *
     * @return float
     */
    public function getClickPriceValue()
    {
        return $this->clickPriceValue;
    }

    /**
     * Set clickPriceType
     *
     * @param integer $clickPriceType
     * @return Provider
     */
    public function setClickPriceType($clickPriceType)
    {
        $this->clickPriceType = $clickPriceType;

        return $this;
    }

    /**
     * Get clickPriceType
     *
     * @return integer
     */
    public function getClickPriceType()
    {
        return $this->clickPriceType;
    }

    /**
     * Set minSalesValue
     *
     * @param integer $minSalesValue
     * @return Provider
     */
    public function setMinSalesValue($minSalesValue)
    {
        $this->minSalesValue = $minSalesValue;

        return $this;
    }

    /**
     * Get minSalesValue
     *
     * @return integer
     */
    public function getMinSalesValue()
    {
        return $this->minSalesValue;
    }

    /**
     * Set minSalesType
     *
     * @param integer $minSalesType
     * @return Provider
     */
    public function setMinSalesType($minSalesType)
    {
        $this->minSalesType = $minSalesType;

        return $this;
    }

    /**
     * Get minSalesType
     *
     * @return integer
     */
    public function getMinSalesType()
    {
        return $this->minSalesType;
    }

    /**
     * Set freeClicks
     *
     * @param integer $freeClicks
     * @return Provider
     */
    public function setFreeClicks($freeClicks)
    {
        $this->freeClicks = $freeClicks;

        return $this;
    }

    /**
     * Get freeClicks
     *
     * @return integer
     */
    public function getFreeClicks()
    {
        return $this->freeClicks;
    }

    /**
     * Set freeClicksType
     *
     * @param integer $freeClicksType
     * @return Provider
     */
    public function setFreeClicksType($freeClicksType)
    {
        $this->freeClicksType = $freeClicksType;

        return $this;
    }

    /**
     * Get freeClicksType
     *
     * @return integer
     */
    public function getFreeClicksType()
    {
        return $this->freeClicksType;
    }

    /**
     * Set utmSource
     *
     * @param string $utmSource
     * @return Provider
     */
    public function setUtmSource($utmSource)
    {
        $this->utmSource = $utmSource;

        return $this;
    }

    /**
     * Get utmSource
     *
     * @return string
     */
    public function getUtmSource()
    {
        return $this->utmSource;
    }

    /**
     * Set utmMedium
     *
     * @param string $utmMedium
     * @return Provider
     */
    public function setUtmMedium($utmMedium)
    {
        $this->utmMedium = $utmMedium;

        return $this;
    }

    /**
     * Get utmMedium
     *
     * @return string
     */
    public function getUtmMedium()
    {
        return $this->utmMedium;
    }

    /**
     * Set utmCampaign
     *
     * @param string $utmCampaign
     * @return Provider
     */
    public function setUtmCampaign($utmCampaign)
    {
        $this->utmCampaign = $utmCampaign;

        return $this;
    }

    /**
     * Get utmCampaign
     *
     * @return string
     */
    public function getUtmCampaign()
    {
        return $this->utmCampaign;
    }

    /**
     * Set activeSince
     *
     * @return Provider
     */
    public function setActiveSince()
    {
        $this->activeSince = new \DateTime();

        return $this;
    }

    /**
     * Get activeSince
     *
     * @return \DateTime
     */
    public function getActiveSince()
    {
        return $this->activeSince;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Provider
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }
}
