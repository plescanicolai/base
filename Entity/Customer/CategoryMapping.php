<?php

namespace Feedify\BaseBundle\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoryMapping
 *
 * @ORM\Table(name="categories_to_markets_categories",options={"collate"="utf8_general_ci"})
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Customer\CategoryMappingRepository")
 */
class CategoryMapping
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
     * @ORM\Column(name="product_id", type="integer", nullable=true)
     */
    private $productId;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=true)
     */
    private $categoryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="market_id", type="integer")
     */
    private $marketId;

    /**
     * @var integer
     *
     * @ORM\Column(name="market_category_id", type="integer")
     */
    private $marketCategoryId;

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
     * @return CategoryMapping
     */
    public function setProductId($productId = null)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return null|integer
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return CategoryMapping
     */
    public function setCategoryId($categoryId = null)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return null|integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set marketId
     *
     * @param integer $marketId
     * @return CategoryMapping
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
     * Set marketCategoryId
     *
     * @param integer $marketCategoryId
     * @return CategoryMapping
     */
    public function setMarketCategoryId($marketCategoryId)
    {
        $this->marketCategoryId = $marketCategoryId;

        return $this;
    }

    /**
     * Get marketCategoryId
     *
     * @return integer
     */
    public function getMarketCategoryId()
    {
        return $this->marketCategoryId;
    }
}
