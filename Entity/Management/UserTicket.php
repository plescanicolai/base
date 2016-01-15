<?php

namespace Feedify\BaseBundle\Entity\Management;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * UserTicket
 *
 * @ORM\Table(name="user_ticket")
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\UserTicketRepository")
 */
class UserTicket
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
     * @ORM\Column(name="username", type="string", length=35)
     */
    private $username;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="at_date", type="datetime")
     */
    private $atDate;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     * @Assert\Image(
     *      mimeTypesMessage = "This file is not a valid image",
     *      maxSize = "5M",
     *      maxSizeMessage = "Too big."
     *      )
     */
    private $image;

    /**
     * @var array
     *
     * @ORM\Column(name="content", type="json_array", nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     *
     */
    public function __construct()
    {
        $this->atDate = new \DateTime();
        $this->status = 'open';
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
     * Set username
     *
     * @param string $username
     * @return UserTicket
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set atDate
     *
     * @param \DateTime $atDate
     * @return UserTicket
     */
    public function setAtDate($atDate)
    {
        $this->atDate = $atDate;
    
        return $this;
    }

    /**
     * Get atDate
     *
     * @return \DateTime
     */
    public function getAtDate()
    {
        return $this->atDate;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return UserTicket
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set content
     *
     * @param array $content
     * @return UserTicket
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return UserTicket
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
