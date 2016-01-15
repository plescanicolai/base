<?php

namespace Feedify\BaseBundle\Entity\Management\Customer;

use Feedify\BaseBundle\Entity\Management\Customer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="customer_roles", options={"collate"="utf8_general_ci"}, uniqueConstraints={@ORM\UniqueConstraint(columns={"role", "customer_id"})} )
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\Customer\RoleRepository")
 * @UniqueEntity(fields={"role", "customer_id"})
 */
class Role implements RoleInterface
{
    /**
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id()
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
    * @ORM\Column(name="role", type="string", length=20)
    */
    private $role;

    /**
    * @ORM\ManyToOne(targetEntity="Feedify\BaseBundle\Entity\Management\Customer", inversedBy="roles")
    * @ORM\JoinColumn(name="customer_id", referencedColumnName="id", onDelete="CASCADE")
    */
    private $customer;

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
     * Set role
     *
     * @param string $role
     * @return Role
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @see RoleInterface
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set customer
     *
     * @param Customer $customer
     * @return Role
     */
    public function setCustomer(Customer $customer = null)
    {
        $this->customer = $customer;
    
        return $this;
    }

    /**
     * Get customer
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
