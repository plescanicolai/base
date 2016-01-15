<?php

namespace Feedify\BaseBundle\Entity\Customer\Product;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Feedify\BaseBundle\Entity\Customer\Product;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ProductDescription
 *
 * @ORM\Table(name="product_description", options={"collate"="utf8_general_ci"}, uniqueConstraints={@ORM\UniqueConstraint(columns={"lang", "product_id"})} )
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Customer\Product\ProductDescriptionRepository")
 * @UniqueEntity(fields={"lang", "product_id"})
 */
class ProductDescription
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
     * @ORM\ManyToOne(targetEntity="Feedify\BaseBundle\Entity\Customer\Product", inversedBy="descriptions")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $product;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="text", nullable=true))
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true))
     */
    private $description;

    /**
     * Manufacturer or brand name
     *
     * @var string
     *
     * @ORM\Column(name="manufacturer", type="string", nullable=true)
     */
    private $manufacturer;

    /**
     * Product base price unit in different languages
     * Ex: per stock, 100 l or 25 g
     *
     * @var string
     *
     * @ORM\Column(name="base_unit", type="string", nullable=true)
     */
    private $baseUnit;

    /**
     * Product variant names in different languages
     * Ex: Size|Color|Material
     *
     * @var string
     *
     * @ORM\Column(name="variant_names", type="string", nullable=true)
     */
    private $variantNames;

    /**
     * Product gender in different languages
     * Ex: male, female, unisex
     *
     * @var string
     *
     * @ORM\Column(name="gender", type="string", nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", nullable=true)
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", nullable=true)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="material", type="string", nullable=true)
     */
    private $material;

    /**
     * Product packet size
     * Ex: 10x10x15 or 100cm 200cm 300cm
     *
     * @var string
     *
     * @ORM\Column(name="packet_size", type="string", nullable=true)
     */
    private $packetSize;

    /**
     * Ex: 24_H, 5_9_D, 1_4_W, 2_M or delivery depending on your location
     *
     * @var string
     *
     * @ORM\Column(name="delivery_time", type="string", nullable=true)
     */
    private $deliveryTime;

    /**
     * Ex: details over the phone
     *
     * @var string
     *
     * @ORM\Column(name="shipping_additional", type="string", nullable=true)
     */
    private $shippingAdditional;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping_comment", type="string", nullable=true)
     */
    private $shippingComment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime")
     */
    private $lastUpdate;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lastUpdate = new \DateTime();
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
     * Set product
     *
     * @param \Feedify\BaseBundle\Entity\Customer\Product $product
     * @return ProductDescription
     */
    public function setProduct(Product $product)
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
     * Set lang
     *
     * @param integer $lang
     * @return ProductDescription
     */
    public function setLang($lang = null)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * @return integer
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ProductDescription
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
     * Set subtitle
     *
     * @param string $subtitle
     * @return ProductDescription
     */
    public function setSubtitle($subtitle = null)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return null|string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ProductDescription
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return null|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set manufacturer
     *
     * @param string $manufacturer
     * @return ProductDescription
     */
    public function setManufacturer($manufacturer = null)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return null|string
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set baseUnit
     *
     * @param string $baseUnit
     * @return ProductDescription
     */
    public function setBaseUnit($baseUnit = null)
    {
        $this->baseUnit = $baseUnit;

        return $this;
    }

    /**
     * Get baseUnit
     *
     * @return null|string
     */
    public function getBaseUnit()
    {
        return $this->baseUnit;
    }

    /**
     * Set variantNames
     *
     * @param string $variantNames
     * @return ProductDescription
     */
    public function setVariantNames($variantNames = null)
    {
        $this->variantNames = $variantNames;

        return $this;
    }

    /**
     * Get variantNames
     *
     * @return null|string
     */
    public function getVariantNames()
    {
        return $this->variantNames;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return ProductDescription
     */
    public function setGender($gender = null)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return null|string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return ProductDescription
     */
    public function setSize($size = null)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return null|string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return ProductDescription
     */
    public function setColor($color = null)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return null|string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set material
     *
     * @param string $material
     * @return ProductDescription
     */
    public function setMaterial($material = null)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material
     *
     * @return null|string
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set packetSize
     *
     * @param string $packetSize
     * @return ProductDescription
     */
    public function setPacketSize($packetSize = null)
    {
        $this->packetSize = $packetSize;

        return $this;
    }

    /**
     * Get packetSize
     *
     * @return null|string
     */
    public function getPacketSize()
    {
        return $this->packetSize;
    }

    /**
     * Set deliveryTime
     *
     * @param string $deliveryTime
     * @return ProductDescription
     */
    public function setDeliveryTime($deliveryTime = null)
    {
        $this->deliveryTime = $deliveryTime;

        return $this;
    }

    /**
     * Get deliveryTime
     *
     * @return null|string
     */
    public function getDeliveryTime()
    {
        return $this->deliveryTime;
    }

    /**
     * Set shippingAdditional
     *
     * @param string $shippingAdditional
     * @return ProductDescription
     */
    public function setShippingAdditional($shippingAdditional = null)
    {
        $this->shippingAdditional = $shippingAdditional;

        return $this;
    }

    /**
     * Get shippingAdditional
     *
     * @return null|string
     */
    public function getShippingAdditional()
    {
        return $this->shippingAdditional;
    }

    /**
     * Set shippingComment
     *
     * @param string $shippingComment
     * @return ProductDescription
     */
    public function setShippingComment($shippingComment = null)
    {
        $this->shippingComment = $shippingComment;

        return $this;
    }

    /**
     * Get shippingPaypal
     *
     * @return null|string
     */
    public function getShippingComment()
    {
        return $this->shippingComment;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     * @return ProductDescription
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    /**
     * Get lastUpdate
     *
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }
}
