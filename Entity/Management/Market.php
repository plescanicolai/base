<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Feedify\BaseBundle\Entity\Management\Market\Description;
use Feedify\BaseBundle\Entity\Management\Market\MarketExport;

/**
 * Market
 *
 * @ORM\Table(name="markets",options={"collate"="utf8_general_ci"})
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\MarketRepository")
 */
class Market
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string")
     */
    private $url;

    /**
     * @ORM\Column(name="image_url", type="string", length=100)
     */
    private $imageUrl;

    /**
     * @ORM\Column(name="big_image", type="string", length=100)
     */
    private $bigImage;

    /**
     * Type of market :
     *  0   -   other
     *  1   -   premium
     *  2   -   price comparison
     *
     * @var integer
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $isActive;

    /**
     * @var integer
     *
     * @ORM\Column(name="mapping", type="boolean")
     */
    private $mapping;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Feedify\BaseBundle\Entity\Management\Market\Description", mappedBy="market", cascade={"all"}))
     */
    private $descriptions;

    /**
     * @ORM\ManyToOne(targetEntity="Feedify\BaseBundle\Entity\Management\Country", inversedBy="markets")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="Feedify\BaseBundle\Entity\Management\Market\MarketExport")
     * @ORM\JoinColumn(name="market_export_id", referencedColumnName="id")
     */
    private $marketExport;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set name
     *
     * @param string $name
     * @return Market
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
     * Set url
     *
     * @param string $url
     * @return Market
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Market
     */
    public function setImageUrl($image)
    {
        $this->imageUrl = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Market
     */
    public function setBigImage($image)
    {
        $this->bigImage = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getBigImage()
    {
        return $this->bigImage;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Market
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Market
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set hasMapping
     *
     * @param boolean $hasMapping
     * @return Market
     */
    public function setMapping($hasMapping)
    {
        $this->mapping = $hasMapping;

        return $this;
    }

    /**
     * Get hasMapping
     *
     * @return boolean
     */
    public function getMapping()
    {
        return $this->mapping;
    }

    /**
     * Add description
     *
     * @param \Feedify\BaseBundle\Entity\Management\Market\Description $description
     * @return Market
     */
    public function addDescription(Description $description)
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
     * @param \Feedify\BaseBundle\Entity\Management\Market\Description $description
     */
    public function removeDescription(Description $description)
    {
        $this->descriptions->removeElement($description);
    }

    /**
     * Set country
     *
     * @param \Feedify\BaseBundle\Entity\Management\Country $country
     * @return Market
     */
    public function setCountry(Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Feedify\BaseBundle\Entity\Management\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set marketExport
     *
     * @param MarketExport $marketExport
     * @return Market
     */
    public function setMarketExport(MarketExport $marketExport = null)
    {
        $this->marketExport = $marketExport;

        return $this;
    }

    /**
     * Get marketExport
     *
     * @return MarketExport
     */
    public function getMarketExport()
    {
        return $this->marketExport;
    }
}
