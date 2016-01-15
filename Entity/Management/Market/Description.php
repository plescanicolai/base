<?php

namespace Feedify\BaseBundle\Entity\Management\Market;

use Feedify\BaseBundle\Entity\Management;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Description
 *
 * @ORM\Table(name="market_descriptions",options={"collate"="utf8_general_ci"}, uniqueConstraints={@ORM\UniqueConstraint(columns={"lang_id", "market_id"})} )
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\Market\DescriptionRepository")
 * @UniqueEntity(fields={"market_id", "lang_id"})
 */
class Description
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
     * @ORM\ManyToOne(targetEntity="Feedify\BaseBundle\Entity\Management\Market", inversedBy="descriptions")
     * @ORM\JoinColumn(name="market_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $market;

    /**
     * @ORM\ManyToOne(targetEntity="Feedify\BaseBundle\Entity\Management\Language")
     * @ORM\JoinColumn(name="lang_id", referencedColumnName="id", onDelete="RESTRICT", nullable=true)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
     * Set market
     *
     * @param \Feedify\BaseBundle\Entity\Management\Market $market
     * @return Description
     */
    public function setMarket(Management\Market $market = null)
    {
        $this->market = $market;
    
        return $this;
    }

    /**
     * Get market
     *
     * @return \Feedify\BaseBundle\Entity\Management\Market 
     */
    public function getMarket()
    {
        return $this->market;
    }

    /**
     * Set language
     *
     * @param \Feedify\BaseBundle\Entity\Management\Language $language
     * @return Description
     */
    public function setLanguage(Management\Language $language = null)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return \Feedify\BaseBundle\Entity\Management\Language 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Description
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
