<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriesGoogle
 *
 * @ORM\Table(name="categories_google")
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\CategoriesGoogleRepository")
 */
class CategoriesGoogle
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="full", type="string")
     */
    private $full;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent", type="smallint", nullable=true)
     */
    private $parent;

    /**
     * @var string
     *
     * @ORM\Column(name="name_de", type="string", length=50)
     */
    private $nameDe;

    /**
     * @var string
     *
     * @ORM\Column(name="full_de", type="string")
     */
    private $fullDe;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_de", type="smallint", nullable=true)
     */
    private $parentDe;


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
     * @return CategoriesGoogle
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
     * Set full
     *
     * @param string $full
     * @return CategoriesGoogle
     */
    public function setFull($full)
    {
        $this->full = $full;

        return $this;
    }

    /**
     * Get full
     *
     * @return string
     */
    public function getFull()
    {
        return $this->full;
    }

    /**
     * Set parent
     *
     * @param integer $parent
     * @return CategoriesGoogle
     */
    public function setParent($parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return null|integer
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set nameDe
     *
     * @param string $nameDe
     * @return CategoriesGoogle
     */
    public function setNameDe($nameDe)
    {
        $this->nameDe = $nameDe;

        return $this;
    }

    /**
     * Get nameDe
     *
     * @return string
     */
    public function getNameDe()
    {
        return $this->nameDe;
    }

    /**
     * Set fullDe
     *
     * @param string $fullDe
     * @return CategoriesGoogle
     */
    public function setFullDe($fullDe)
    {
        $this->fullDe = $fullDe;

        return $this;
    }

    /**
     * Get fullDe
     *
     * @return string
     */
    public function getFullDe()
    {
        return $this->fullDe;
    }

    /**
     * Set parentDe
     *
     * @param integer $parentDe
     * @return CategoriesGoogle
     */
    public function setParentDe($parentDe = null)
    {
        $this->parentDe = $parentDe;

        return $this;
    }

    /**
     * Get parentDe
     *
     * @return null|integer
     */
    public function getParentDe()
    {
        return $this->parentDe;
    }
}
