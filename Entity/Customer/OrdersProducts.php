<?php

namespace Feedify\BaseBundle\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\DateTime;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * OrdersProducts
 *
 * @ORM\Table(name="orders_products", options={"collate"="utf8_general_ci"}, uniqueConstraints={@ORM\UniqueConstraint(columns={"order_id", "product_id"})})
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Customer\OrdersProductsRepository")
 */
class OrdersProducts
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Feedify\BaseBundle\Entity\Customer\Orders", inversedBy="orderProducts")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $order;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer")
     */
    private $productId;

    /**
     * @var string
     *
     * @ORM\Column(name="product_model", type="string", length=40)
     */
    private $productModel;

    /**
     * @var float
     *
     * @ORM\Column(name="product_price", type="float")
     */
    private $productPrice;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_quantity", type="integer")
     */
    private $productQuantity;

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
     * Set order
     *
     * @param \Feedify\BaseBundle\Entity\Customer\Orders $order
     * @return OrdersProducts
     */
    public function setOrder(Orders $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Feedify\BaseBundle\Entity\Customer\Orders
     */
    public function getOrder()
    {
        return $this->order;
    }



    /**
     * Set productId
     *
     * @param integer $productId
     * @return OrdersProducts
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
     * Set productModel
     *
     * @param string $productModel
     * @return OrdersProducts
     */
    public function setProductModel($productModel)
    {
        $this->productModel = $productModel;

        return $this;
    }

    /**
     * Get productModel
     *
     * @return string
     */
    public function getProductModel()
    {
        return $this->productModel;
    }

    /**
     * Set productPrice
     *
     * @param float $productPrice
     * @return OrdersProducts
     */
    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    /**
     * Get productPrice
     *
     * @return float
     */
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * Set productQuantity
     *
     * @param integer $productQuantity
     * @return OrdersProducts
     */
    public function setProductQuantity($productQuantity)
    {
        $this->productQuantity = $productQuantity;

        return $this;
    }

    /**
     * Get productQuantity
     *
     * @return integer
     */
    public function getProductQuantity()
    {
        return $this->productQuantity;
    }
}
