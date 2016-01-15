<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="countries",options={"collate"="utf8_general_ci"})
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\CountryRepository")
 */
class Country
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(name="id", type="string", length=2)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     *  @ORM\OneToMany(targetEntity="Feedify\BaseBundle\Entity\Management\CountryDescription", mappedBy="country", cascade={"all"}))
     */
    private $descriptions;

    /**
     * @var ArrayCollection
     *
     *  @ORM\OneToMany(targetEntity="Feedify\BaseBundle\Entity\Management\Market", mappedBy="country", cascade={"all"}))
     */
    private $markets;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->descriptions = new ArrayCollection();
        $this->markets = new ArrayCollection();
    }

    /**
     * Set id
     *
     * @param string $id
     * @return Country
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Country
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
     * Add description
     *
     * @param CountryDescription $description
     * @return Country
     */
    public function addDescription(CountryDescription $description)
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
     * @param CountryDescription $description
     */
    public function removeDescription(CountryDescription $description)
    {
        $this->descriptions->removeElement($description);
    }

    /**
     * Get Country Description by language
     *
     * @param integer $languageId
     * @return CountryDescription
     */
    public function getCountryDescriptionByLanguage($languageId = 2)
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('languageId', $languageId));

        return $this->descriptions->matching($criteria)->current();
    }

    /**
     * Add markets
     *
     * @param Market $markets
     * @return Country
     */
    public function addMarket(Market $markets)
    {
        $this->markets[] = $markets;

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
     * Remove markets
     *
     * @param Market $markets
     */
    public function removeMarket(Market $markets)
    {
        $this->markets->removeElement($markets);
    }
}
