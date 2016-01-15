<?php

namespace Feedify\BaseBundle\Entity\Customer\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * Channel
 *
 * @ORM\Table(name="product_channels", options={"collate"="utf8_general_ci"}, uniqueConstraints={@ORM\UniqueConstraint(columns={"product_id"})})
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Customer\Product\ChannelRepository")
 */
class Channel
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
     * @ORM\Column(name="product_id", type="integer")
     */
    private $productId;

    /**
     * @ORM\Column(name="coupon", type="string", nullable=true)
     */
    private $coupon;

    /**
     * @ORM\Column(name="products_delivery_time", type="string", length=64, nullable=true)
     */
    private $productsDeliveryTime;

    /**
     * @ORM\Column(name="products_shipping", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $productsShipping;

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
     * Set productId
     *
     * @param integer $productId
     * @return Channel
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
     * Set coupon
     *
     * @param string $coupon
     * @return Channel
     */
    public function setCoupon($coupon)
    {
        $this->coupon = $coupon;
    
        return $this;
    }

    /**
     * Get coupon
     *
     * @return string
     */
    public function getCoupon()
    {
        return $this->coupon;
    }

    /**
     * Set productsDeliveryTime
     *
     * @param string $productsDeliveryTime
     * @return Channel
     */
    public function setProductsDeliveryTime($productsDeliveryTime)
    {
        $this->productsDeliveryTime = $productsDeliveryTime;
    
        return $this;
    }

    /**
     * Get productsDeliveryTime
     *
     * @return string
     */
    public function getProductsDeliveryTime()
    {
        return $this->productsDeliveryTime;
    }

    /**
     * Set productsShipping
     *
     * @param float $productsShipping
     * @return Channel
     */
    public function setProductsShipping($productsShipping)
    {
        $this->productsShipping = $productsShipping;
    
        return $this;
    }

    /**
     * Get productsShipping
     *
     * @return float
     */
    public function getProductsShipping()
    {
        return $this->productsShipping;
    }
}
