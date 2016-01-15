<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rules Entity
 *
 * @ORM\Table(name="rules",options={"collate"="utf8_general_ci"})
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\RulesRepository")
 */
class Rules
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Filter created at
     *
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Feedify\BaseBundle\Entity\Management\Filter" )
     * @ORM\JoinColumn(name="filter", referencedColumnName="id", onDelete="RESTRICT")
     */
    private $filter;

    /**
     * Possible values :
     *      0   -   deactivate all products
     *      1   -   activate all products
     *
     * @ORM\Column(name="activation_type", type="boolean")
     */
    private $activationType;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * Filter active from
     *
     * @ORM\Column(type="date" , name="active_from",  nullable=true)
     */
    private $activeFrom;

    /**
     * Filter active to
     *
     * @ORM\Column(type="date" , name="active_to",  nullable=true)
     */
    private $activeTo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dateCreated = new \DateTime();
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Rules
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Rules
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set filter
     *
     * @param \Feedify\BaseBundle\Entity\Management\Filter $filter
     * @return Rules
     */
    public function setFilter(Filter $filter = null)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * Get filter
     *
     * @return \Feedify\BaseBundle\Entity\Management\Filter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * Set activationType
     *
     * @param boolean $activationType
     * @return Rules
     */
    public function setActivationType($activationType)
    {
        $this->activationType = $activationType;

        return $this;
    }

    /**
     * Get activationType
     *
     * @return boolean
     */
    public function getActivationType()
    {
        return $this->activationType;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return Rules
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Rules
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set activeFrom
     *
     * @param \DateTime $activeFrom
     * @return Rules
     */
    public function setActiveFrom($activeFrom)
    {
        $this->activeFrom = $activeFrom;

        return $this;
    }

    /**
     * Get activeFrom
     *
     * @return \DateTime
     */
    public function getActiveFrom()
    {
        return $this->activeFrom;
    }

    /**
     * Set activeTo
     *
     * @param \DateTime $activeTo
     * @return Rules
     */
    public function setActiveTo($activeTo)
    {
        $this->activeTo = $activeTo;

        return $this;
    }

    /**
     * Get activeTo
     *
     * @return \DateTime
     */
    public function getActiveTo()
    {
        return $this->activeTo;
    }
}
