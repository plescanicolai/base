<?php

namespace Feedify\BaseBundle\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Orders
 *
 * @ORM\Table(name="orders",options={"collate"="utf8_general_ci"})
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Customer\OrdersRepository")
 */
class Orders
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="order_number", type="string", length=50)
     */
    private $orderNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="market_id", type="integer")
     */
    private $marketId;

    /**
     * @var float
     *
     * @ORM\Column(name="order_price", type="float")
     */
    private $orderPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="order_currency", type="string", length=20)
     */
    private $orderCurrency;

    /**
     * @var string
     *
     * @ORM\Column(name="order_session", type="string", length=50)
     */
    private $orderSession;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_address", type="string", length=30)
     */
    private $ipAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="browser", type="string", length=100)
     */
    private $browser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_date", type="datetime")
     */
    private $orderDate;

    /**
     * @var ArrayCollection $orderProducts
     *
     * @ORM\OneToMany(targetEntity="Feedify\BaseBundle\Entity\Customer\OrdersProducts", mappedBy="order", cascade={"all"})
     */
    private $orderProducts;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderDate = new \DateTime();
        $this->orderProducts = new ArrayCollection();
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
     * Set orderNumber
     *
     * @param string $orderNumber
     * @return Orders
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get orderNumber
     *
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * Set marketId
     *
     * @param integer $marketId
     * @return Orders
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
     * Set orderPrice
     *
     * @param float $orderPrice
     * @return Orders
     */
    public function setOrderPrice($orderPrice)
    {
        $this->orderPrice = $orderPrice;

        return $this;
    }

    /**
     * Get orderPrice
     *
     * @return float
     */
    public function getOrderPrice()
    {
        return $this->orderPrice;
    }

    /**
     * Set orderCurrency
     *
     * @param string $orderCurrency
     * @return Orders
     */
    public function setOrderCurrency($orderCurrency)
    {
        $this->orderCurrency = $orderCurrency;

        return $this;
    }

    /**
     * Get orderCurrency
     *
     * @return string
     */
    public function getOrderCurrency()
    {
        return $this->orderCurrency;
    }

    /**
     * Set orderSession
     *
     * @param string $orderSession
     * @return Orders
     */
    public function setOrderSession($orderSession)
    {
        $this->orderSession = $orderSession;

        return $this;
    }

    /**
     * Get orderSession
     *
     * @return string
     */
    public function getOrderSession()
    {
        return $this->orderSession;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return Orders
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set browser
     *
     * @param string $browser
     * @return Orders
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;

        return $this;
    }

    /**
     * Get browser
     *
     * @return string
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Set orderDate
     *
     * @param \DateTime $orderDate
     * @return Orders
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * Get orderDate
     *
     * @return \DateTime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Add orderProducts
     *
     * @param \Feedify\BaseBundle\Entity\Customer\OrdersProducts $orderProduct
     * @return Orders
     */
    public function addOrderProduct(OrdersProducts $orderProduct)
    {
        $this->orderProducts[] = $orderProduct;

        return $this;
    }

    /**
     * Get orderProducts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderProducts()
    {
        return $this->orderProducts;
    }

    /**
     * Remove orderProducts
     *
     * @param \Feedify\BaseBundle\Entity\Customer\OrdersProducts $orderProduct
     */
    public function removeOrderProduct(OrdersProducts $orderProduct)
    {
        $this->orderProducts->removeElement($orderProduct);
    }
}
