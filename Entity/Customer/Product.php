<?php

namespace Feedify\BaseBundle\Entity\Customer;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Feedify\BaseBundle\Entity\Customer\Product\Category;
use Feedify\BaseBundle\Constant\Customer\Product as ProductConstant;
use Feedify\BaseBundle\Entity\Customer\Product\ProductDescription;
use Feedify\BaseBundle\Entity\Customer\Product\ProductsToMarkets;

/**
 * Product
 *
 * @ORM\Table(name="products", options={"collate"="utf8_general_ci"})
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Customer\ProductRepository")
 */
class Product
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
     * @var ArrayCollection $markets
     *
     * @ORM\OneToMany(targetEntity="Feedify\BaseBundle\Entity\Customer\Product\ProductsToMarkets", mappedBy="product", cascade={"all"})
     */
    private $markets;

    /**
     * @var ArrayCollection $description
     *
     * @ORM\OneToMany(targetEntity="Feedify\BaseBundle\Entity\Customer\Product\ProductDescription", mappedBy="product", cascade={"all"})
     */
    private $descriptions;

    /**
     * Product variant ids ([product shop id]_[option id]-[option value id]...)
     * Ex: 21_3-4_5-6_8-9
     *
     * @var string
     *
     * @ORM\Column(name="model_own", type="string", unique=true)
     */
    private $modelOwn;

    /**
     * @var string
     *
     * @ORM\Column(name="product_url", type="string")
     */
    private $productUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url", type="string", nullable=true)
     */
    private $imageUrl;

    /**
     * Serial number, product number, manufacturer number id
     *
     * @var string
     *
     * @ORM\Column(name="model", type="string", nullable=true)
     */
    private $model;

    /**
     * @var Category $category
     *
     * @ORM\ManyToOne(targetEntity="Feedify\BaseBundle\Entity\Customer\Product\Category")
     * @ORM\JoinColumn(name="category", referencedColumnName="id", onDelete="SET NULL")
     */
    private $category;

    /**
     * European article number
     *
     * @var string
     *
     * @ORM\Column(name="ean", type="string", nullable=true)
     */
    private $ean;

    /**
     * International Standard Book Number
     *
     * @var string
     *
     * @ORM\Column(name="isbn", type="string", nullable=true)
     */
    private $isbn;

    /**
     * Product price with taxes and evaluated in specified currency
     *
     * @var float
     *
     * @ORM\Column(name="price_brut", type="float")
     */
    private $priceBrut;

    /**
     * Product price special with taxes and evaluated in specified currency
     *
     * @var float
     *
     * @ORM\Column(name="price_special", type="float", nullable=true)
     */
    private $priceSpecial;

    /**
     * Recommended manufacturer or retail price
     *
     * @var float
     *
     * @ORM\Column(name="price_uvp", type="float", nullable=true)
     */
    private $priceUvp;

    /**
     * Product price per unit
     *
     * @var float
     *
     * @ORM\Column(name="price_base", type="float", nullable=true)
     */
    private $priceBase;

    /**
     * Product tax in percent (%)
     *
     * @var float
     *
     * @ORM\Column(name="tax_ratio", type="float", nullable=true)
     */
    private $taxRatio;

    /**
     * Product currency code
     * Ex: EUR, USD, ...
     *
     * @var string
     *
     * @ORM\Column(name="currency", type="string", nullable=true)
     */
    private $currency;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * Product weight in kg
     *
     * @var float
     *
     * @ORM\Column(name="weight", type="float", nullable=true)
     */
    private $weight;

    /**
     * Possible values :
     *      1   :   in stock
     *      2   :   out of stock
     *      3   :   preorder (You’re currently taking orders for this product, but it’s not yet been released.)
     *
     * @var integer
     *
     * @ORM\Column(name="availability_txt", type="integer", nullable=true)
     */
    private $availabilityTxt;

    /**
     * Possible values :
     *      1   :  new
     *      2   :  used
     *      3   :  refurbished
     *
     * @var integer
     *
     * @ORM\Column(name="product_condition", type="integer", nullable=true)
     */
    private $condition;

    /**
     * @var string
     *
     * @ORM\Column(name="coupon", type="string", nullable=true)
     */
    private $coupon;

    /**
     * @var float
     *
     * @ORM\Column(name="shipping", type="float", nullable=true)
     */
    private $shipping;

    /**
     * Shipping cost Paypal Austria
     *
     * @var float
     *
     * @ORM\Column(name="shipping_paypal_ost", type="float", nullable=true)
     */
    private $shippingPaypalOst;

    /**
     * Shipping cost COD (cash on delivery)
     *
     * @var float
     *
     * @ORM\Column(name="shipping_cod", type="float", nullable=true)
     */
    private $shippingCod;

    /**
     * @var float
     *
     * @ORM\Column(name="shipping_credit_card", type="float", nullable=true)
     */
    private $shippingCreditCard;

    /**
     * @var float
     *
     * @ORM\Column(name="shipping_paypal", type="float", nullable=true)
     */
    private $shippingPaypal;

    /**
     * @var float
     *
     * @ORM\Column(name="shipping_transfer", type="float", nullable=true)
     */
    private $shippingTransfer;

    /**
     * @var float
     *
     * @ORM\Column(name="shipping_debit", type="float", nullable=true)
     */
    private $shippingDebit;

    /**
     * @var float
     *
     * @ORM\Column(name="shipping_account", type="float", nullable=true)
     */
    private $shippingAccount;

    /**
     * @var float
     *
     * @ORM\Column(name="shipping_moneybookers", type="float", nullable=true)
     */
    private $shippingMoneybookers;

    /**
     * @var float
     *
     * @ORM\Column(name="shipping_giropay", type="float", nullable=true)
     */
    private $shippingGiropay;

    /**
     * @var float
     *
     * @ORM\Column(name="shipping_click_buy", type="float", nullable=true)
     */
    private $shippingClickBuy;

    /**
     * Possible values :
     *      0   :  inactive
     *      1   :  active
     *
     * @var integer
     *
     * @ORM\Column(name="status", type="boolean"))
     */
    private $status;

    /**
     * Possible values :
     *      -1  :  default (check table markets)
     *      0   :  unavailable to export
     *      1   :  available to export
     *
     * @var integer
     *
     * @ORM\Column(name="status_market", type="integer"))
     */
    private $statusMarket;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->status = false;
        $this->statusMarket = ProductConstant::STATUSMARKET_DEFAULT;
        $this->markets = new ArrayCollection();
        $this->descriptions = new ArrayCollection();
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
     * Add market
     *
     * @param \Feedify\BaseBundle\Entity\Customer\Product\ProductsToMarkets $market
     * @return Product
     */
    public function addMarket(ProductsToMarkets $market)
    {
        $this->markets[] = $market;

        return $this;
    }

    /**
     * Get markets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMarkets()
    {
        return $this->markets;
    }

    /**
     * Remove market
     *
     * @param \Feedify\BaseBundle\Entity\Customer\Product\ProductsToMarkets $market
     */
    public function removeMarket(ProductsToMarkets $market)
    {
        $this->markets->removeElement($market);
    }

    /**
     * Get ProductsToMarkets by marketId
     *
     * @param integer $marketId
     * @return ProductDescription
     */
    public function getProductToMarketByMarketId($marketId)
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('marketId', $marketId));

        return $this->markets->matching($criteria)->current();
    }

    /**
     * Add description
     *
     * @param \Feedify\BaseBundle\Entity\Customer\Product\ProductDescription $description
     * @return Product
     */
    public function addDescription(ProductDescription $description)
    {
        $this->descriptions[] = $description;

        return $this;
    }

    /**
     * Get descriptions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * Remove description
     *
     * @param \Feedify\BaseBundle\Entity\Customer\Product\ProductDescription $description
     */
    public function removeDescription(ProductDescription $description)
    {
        $this->descriptions->removeElement($description);
    }

    /**
     * Get Product Description by language
     *
     * @param integer $languageId
     * @return ProductDescription
     */
    public function getProductDescriptionByLanguage($languageId)
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('lang', $languageId));

        return $this->descriptions->matching($criteria)->current();
    }

    /**
     * Set modelOwn
     *
     * @param string $modelOwn
     * @return Product
     */
    public function setModelOwn($modelOwn)
    {
        $this->modelOwn = $modelOwn;

        return $this;
    }

    /**
     * Get modelOwn
     *
     * @return string
     */
    public function getModelOwn()
    {
        return $this->modelOwn;
    }

    /**
     * Set productUrl
     *
     * @param string $productUrl
     * @return Product
     */
    public function setProductUrl($productUrl)
    {
        $this->productUrl = $productUrl;

        return $this;
    }

    /**
     * Get productUrl
     *
     * @return string
     */
    public function getProductUrl()
    {
        return $this->productUrl;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     * @return Product
     */
    public function setImageUrl($imageUrl = null)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return null|string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set model
     *
     * @param string $model
     * @return Product
     */
    public function setModel($model = null)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return null|string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set category
     *
     * @param \Feedify\BaseBundle\Entity\Customer\Product\Category $category
     * @return Product
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Feedify\BaseBundle\Entity\Customer\Product\Category $category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set ean
     *
     * @param string $ean
     * @return Product
     */
    public function setEan($ean = null)
    {
        $this->ean = $ean;

        return $this;
    }

    /**
     * Get ean
     *
     * @return null|string
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     * @return Product
     */
    public function setIsbn($isbn = null)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return null|string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set priceBrut
     *
     * @param float $priceBrut
     * @return Product
     */
    public function setPriceBrut($priceBrut)
    {
        $this->priceBrut = $priceBrut;

        return $this;
    }

    /**
     * Get priceBrut
     *
     * @return float
     */
    public function getPriceBrut()
    {
        return $this->priceBrut;
    }

    /**
     * Set priceSpecial
     *
     * @param float $priceSpecial
     * @return Product
     */
    public function setPriceSpecial($priceSpecial = null)
    {
        $this->priceSpecial = $priceSpecial;

        return $this;
    }

    /**
     * Get priceSpecial
     *
     * @return null|float
     */
    public function getPriceSpecial()
    {
        return $this->priceSpecial;
    }

    /**
     * Set priceUvp
     *
     * @param float $priceUvp
     * @return Product
     */
    public function setPriceUvp($priceUvp = null)
    {
        $this->priceUvp = $priceUvp;

        return $this;
    }

    /**
     * Get priceUvp
     *
     * @return null|float
     */
    public function getPriceUvp()
    {
        return $this->priceUvp;
    }

    /**
     * Set priceBase
     *
     * @param float $priceBase
     * @return Product
     */
    public function setPriceBase($priceBase = null)
    {
        $this->priceBase = $priceBase;

        return $this;
    }

    /**
     * Get priceBase
     *
     * @return null|float
     */
    public function getPriceBase()
    {
        return $this->priceBase;
    }

    /**
     * Set taxRation
     *
     * @param float $taxRatio
     * @return Product
     */
    public function setTaxRatio($taxRatio = null)
    {
        $this->taxRatio = $taxRatio;

        return $this;
    }

    /**
     * Get taxRation
     *
     * @return null|float
     */
    public function getTaxRatio()
    {
        return $this->taxRatio;
    }

    /**
     * Set currency
     *
     * @param string $currency
     * @return Product
     */
    public function setCurrency($currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return null|string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Product
     */
    public function setQuantity($quantity = null)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return null|integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set weight
     *
     * @param float $weight
     * @return Product
     */
    public function setWeight($weight = null)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return null|float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set availabilityTxt
     *
     * @param integer $availabilityTxt
     * @return Product
     */
    public function setAvailabilityTxt($availabilityTxt = null)
    {
        $this->availabilityTxt = $availabilityTxt;

        return $this;
    }

    /**
     * Get availabilityTxt
     *
     * @return null|integer
     */
    public function getAvailabilityTxt()
    {
        return $this->availabilityTxt;
    }

    /**
     * Set condition
     *
     * @param integer $condition
     * @return Product
     */
    public function setCondition($condition = null)
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * Get condition
     *
     * @return null|integer
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Set coupon
     *
     * @param string $coupon
     * @return Product
     */
    public function setCoupon($coupon = null)
    {
        $this->coupon = $coupon;

        return $this;
    }

    /**
     * Get coupon
     *
     * @return null|string
     */
    public function getCoupon()
    {
        return $this->coupon;
    }

    /**
     * Set shipping
     *
     * @param float $shipping
     * @return Product
     */
    public function setShipping($shipping = null)
    {
        $this->shipping = $shipping;

        return $this;
    }

    /**
     * Get shipping
     *
     * @return null|float
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * Set shippingPaypalOst
     *
     * @param float $shippingPaypalOst
     * @return Product
     */
    public function setShippingPaypalOst($shippingPaypalOst = null)
    {
        $this->shippingPaypalOst = $shippingPaypalOst;

        return $this;
    }

    /**
     * Get shippingPaypalOst
     *
     * @return null|float
     */
    public function getShippingPaypalOst()
    {
        return $this->shippingPaypalOst;
    }

    /**
     * Set shippingCod
     *
     * @param float $shippingCod
     * @return Product
     */
    public function setShippingCod($shippingCod = null)
    {
        $this->shippingCod = $shippingCod;

        return $this;
    }

    /**
     * Get shippingCod
     *
     * @return null|float
     */
    public function getShippingCod()
    {
        return $this->shippingCod;
    }

    /**
     * Set shippingCreditCard
     *
     * @param float $shippingCreditCard
     * @return Product
     */
    public function setShippingCreditCard($shippingCreditCard = null)
    {
        $this->shippingCreditCard = $shippingCreditCard;

        return $this;
    }

    /**
     * Get shippingCreditCard
     *
     * @return null|float
     */
    public function getShippingCreditCard()
    {
        return $this->shippingCreditCard;
    }

    /**
     * Set shippingPaypal
     *
     * @param float $shippingPaypal
     * @return Product
     */
    public function setShippingPaypal($shippingPaypal = null)
    {
        $this->shippingPaypal = $shippingPaypal;

        return $this;
    }

    /**
     * Get shippingPaypal
     *
     * @return null|float
     */
    public function getShippingPaypal()
    {
        return $this->shippingPaypal;
    }

    /**
     * Set shippingTransfer
     *
     * @param float $shippingTransfer
     * @return Product
     */
    public function setShippingTransfer($shippingTransfer = null)
    {
        $this->shippingTransfer = $shippingTransfer;

        return $this;
    }

    /**
     * Get shippingTransfer
     *
     * @return null|float
     */
    public function getShippingTransfer()
    {
        return $this->shippingTransfer;
    }

    /**
     * Set shippingDebit
     *
     * @param float $shippingDebit
     * @return Product
     */
    public function setShippingDebit($shippingDebit = null)
    {
        $this->shippingDebit = $shippingDebit;

        return $this;
    }

    /**
     * Get shippingDebit
     *
     * @return null|float
     */
    public function getShippingDebit()
    {
        return $this->shippingDebit;
    }

    /**
     * Set shippingAccount
     *
     * @param float $shippingAccount
     * @return Product
     */
    public function setShippingAccount($shippingAccount = null)
    {
        $this->shippingAccount = $shippingAccount;

        return $this;
    }

    /**
     * Get shippingPaypal
     *
     * @return null|float
     */
    public function getShippingAccount()
    {
        return $this->shippingAccount;
    }

    /**
     * Set shippingMoneybookers
     *
     * @param float $shippingMoneybookers
     * @return Product
     */
    public function setShippingMoneybookers($shippingMoneybookers = null)
    {
        $this->shippingMoneybookers = $shippingMoneybookers;

        return $this;
    }

    /**
     * Get shippingMoneybookers
     *
     * @return null|float
     */
    public function getShippingMoneybookers()
    {
        return $this->shippingMoneybookers;
    }

    /**
     * Set shippingGiropay
     *
     * @param float $shippingGiropay
     * @return Product
     */
    public function setShippingGiropay($shippingGiropay = null)
    {
        $this->shippingGiropay = $shippingGiropay;

        return $this;
    }

    /**
     * Get shippingGiropay
     *
     * @return null|float
     */
    public function getShippingGiropay()
    {
        return $this->shippingGiropay;
    }

    /**
     * Set shippingClickBuy
     *
     * @param float $shippingClickBuy
     * @return Product
     */
    public function setShippingClickBuy($shippingClickBuy = null)
    {
        $this->shippingClickBuy = $shippingClickBuy;

        return $this;
    }

    /**
     * Get shippingClickBuy
     *
     * @return null|float
     */
    public function getShippingClickBuy()
    {
        return $this->shippingClickBuy;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Product
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

    /**
     * Set statusMarket
     *
     * @param integer $statusMarket
     * @return Product
     */
    public function setStatusMarket($statusMarket)
    {
        $this->statusMarket = $statusMarket;

        return $this;
    }

    /**
     * Get statusMarket
     *
     * @return integer
     */
    public function getStatusMarket()
    {
        return $this->statusMarket;
    }
}
