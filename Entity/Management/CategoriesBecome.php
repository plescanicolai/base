<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriesBecome
 *
 * @ORM\Table(name="categories_become")
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\CategoriesBecomeRepository")
 */
class CategoriesBecome
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
     * @return CategoriesBecome
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
     * @return CategoriesBecome
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
     * @return CategoriesBecome
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
}
