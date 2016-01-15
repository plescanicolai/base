<?php
namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\ORM\Mapping as ORM;

/**
 * Scheduler
 *
 * @ORM\Entity
 * @ORM\Table(name="scheduler",uniqueConstraints={@ORM\UniqueConstraint(name="unique_idx", columns={"clientid","userid","type"})})
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\SchedulerRepository")
 */
class Scheduler
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="string")
     */
    private $clientId;

    /**
     * Same as clientid, just for future functionality
     *
     * @ORM\Column(type="string")
     */
    private $userId;

    /**
     * 1 - error; 0 - ready; 1 - upload; 2 - import
     *
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * 1 - auto import
     *
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * Secure json type - the latest information about the work
     *
     * @ORM\Column(type="json_array")
     */
    private $data;

    /**
     * Working in the parameters (optional parameters field)
     *
     * @ORM\Column(type="json_array")
     */
    private $parameters;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->startDate = new \DateTime();
        $this->status = 0;
        $this->data = array();
        $this->parameters = array();
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
     * Set status
     *
     * @param integer $status
     * @return Scheduler
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
     * Set type
     *
     * @param integer $type
     * @return Scheduler
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
     * Set data
     *
     * @param string $data
     * @return Scheduler
     */
    public function setData($data)
    {
        $this->data = $data;
    
        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set parameters
     *
     * @param string $parameters
     * @return Scheduler
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    
        return $this;
    }

    /**
     * Get parameters
     *
     * @return string
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Set clientId
     *
     * @param string $clientId
     * @return Scheduler
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set userId
     *
     * @param string $userId
     * @return Scheduler
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Scheduler
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }
}
