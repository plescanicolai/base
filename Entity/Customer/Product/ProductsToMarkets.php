<?php

namespace Feedify\BaseBundle\Entity\Customer\Product;

use Doctrine\ORM\Mapping as ORM;
use Feedify\BaseBundle\Entity\Customer\Product;

/**
 * ProductsToMarkets
 *
 * @ORM\Table(name="products_to_markets")
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Customer\Product\ProductsToMarketsRepository")
 */
class ProductsToMarkets
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
     * @ORM\ManyToOne(targetEntity="Feedify\BaseBundle\Entity\Customer\Product", inversedBy="markets")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $product;

    /**
     * @var integer
     *
     * @ORM\Column(name="market_id", type="integer"))
     */
    private $marketId;

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
     * Set product
     *
     * @param \Feedify\BaseBundle\Entity\Customer\Product $product
     * @return ProductsToMarkets
     */
    public function setProduct(Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Feedify\BaseBundle\Entity\Customer\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set marketId
     *
     * @param integer $marketId
     * @return ProductsToMarkets
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
}
