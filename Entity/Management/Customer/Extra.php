<?php

namespace Feedify\BaseBundle\Entity\Management\Customer;

use Feedify\BaseBundle\Entity\Management\Customer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Extra
 *
 * @ORM\Table(name="customer_extra", options={"collate"="utf8_general_ci"}, uniqueConstraints={@ORM\UniqueConstraint(columns={"customer_id", "token"})} )
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\Customer\ExtraRepository")
 * @UniqueEntity(fields={ "customer_id" , "token"})
 *
 */
class Extra
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
     * @ORM\OneToOne(targetEntity="Feedify\BaseBundle\Entity\Management\Customer" , inversedBy="extra")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id", onDelete="CASCADE",  nullable=false)
     */
    private $customer;

    /**
     * @var integer
     *
     * @ORM\Column(name="partner_id", type="integer", nullable=true)
     */
    private $partnerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="tarif_id", type="integer")
     */
    private $tarifId;

    /**
     * @var string
     *
     * @ORM\Column(name="setup_step", type="string")
     */
    private $setupStep;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string")
     */
    private $token;


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
     * Set customer
     *
     * @param \Feedify\BaseBundle\Entity\Management\Customer $customer
     * @return Extra
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \Feedify\BaseBundle\Entity\Management\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set partnerId
     *
     * @param integer $partnerId
     * @return Extra
     */
    public function setPartnerId($partnerId)
    {
        $this->partnerId = $partnerId;
    
        return $this;
    }

    /**
     * Get partnerId
     *
     * @return integer
     */
    public function getPartnerId()
    {
        return $this->partnerId;
    }

    /**
     * Set tarifId
     *
     * @param integer $tarifId
     * @return Extra
     */
    public function setTarifId($tarifId)
    {
        $this->tarifId = $tarifId;
    
        return $this;
    }

    /**
     * Get tarifId
     *
     * @return integer
     */
    public function getTarifId()
    {
        return $this->tarifId;
    }

    /**
     * Set setupStep
     *
     * @param string $setupStep
     * @return Extra
     */
    public function setSetupStep($setupStep)
    {
        $this->setupStep = $setupStep;
    
        return $this;
    }

    /**
     * Get setupStep
     *
     * @return string
     */
    public function getSetupStep()
    {
        return $this->setupStep;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Extra
     */
    public function setToken($token)
    {
        $this->token = $token;
    
        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}
