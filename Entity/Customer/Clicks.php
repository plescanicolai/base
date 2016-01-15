<?php

namespace Feedify\BaseBundle\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clicks
 *
 * @ORM\Table(name="clicks", options={"collate"="utf8_general_ci"})
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Customer\ClicksRepository")
 */
class Clicks
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="market_id", type="integer")
     */
    private $marketId;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer")
     */
    private $productId;

    /**
     * @var string
     *
     * @ORM\Column(name="click_url", type="string", length=200)
     */
    private $clickUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="click_session", type="string", length=50)
     */
    private $clickSession;

    /**
     * @var string
     *
     * @ORM\Column(name="click_client_ip", type="string", length=50)
     */
    private $clickClientIp;

    /**
     * @var string
     *
     * @ORM\Column(name="click_client_browser", type="string", length=200)
     */
    private $clickClientBrowser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="click_date", type="datetime")
     */
    private $clickDate;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clickDate = new \DateTime();
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
     * Set marketId
     *
     * @param integer $marketId
     * @return Clicks
     */
    public function setMarketId($marketId)
    {
        $this->marketId = $marketId;

        return $this;
    }

    /**
     * Get marketId
     *
     * @return integer
     */
    public function getMarketId()
    {
        return $this->marketId;
    }

    /**
     * Set productId
     *
     * @param integer $productId
     * @return Clicks
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return integer
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set clickUrl
     *
     * @param string $clickUrl
     * @return Clicks
     */
    public function setClickUrl($clickUrl)
    {
        $this->clickUrl = $clickUrl;

        return $this;
    }

    /**
     * Get clickUrl
     *
     * @return string
     */
    public function getClickUrl()
    {
        return $this->clickUrl;
    }

    /**
     * Set clickSession
     *
     * @param string $clickSession
     * @return Clicks
     */
    public function setClickSession($clickSession)
    {
        $this->clickSession = $clickSession;

        return $this;
    }

    /**
     * Get clickSession
     *
     * @return string
     */
    public function getClickSession()
    {
        return $this->clickSession;
    }

    /**
     * Set clickClientIp
     *
     * @param string $clickClientIp
     * @return Clicks
     */
    public function setClickClientIp($clickClientIp)
    {
        $this->clickClientIp = $clickClientIp;

        return $this;
    }

    /**
     * Get clickClientIp
     *
     * @return string
     */
    public function getClickClientIp()
    {
        return $this->clickClientIp;
    }

    /**
     * Set clickClientBrowser
     *
     * @param string $clickClientBrowser
     * @return Clicks
     */
    public function setClickClientBrowser($clickClientBrowser)
    {
        $this->clickClientBrowser = $clickClientBrowser;

        return $this;
    }

    /**
     * Get clickClientBrowser
     *
     * @return string
     */
    public function getClickClientBrowser()
    {
        return $this->clickClientBrowser;
    }

    /**
     * Set clickDate
     *
     * @param \DateTime $clickDate
     * @return Clicks
     */
    public function setClickDate($clickDate)
    {
        $this->clickDate = $clickDate;

        return $this;
    }

    /**
     * Get clickDate
     *
     * @return \DateTime
     */
    public function getClickDate()
    {
        return $this->clickDate;
    }
}
