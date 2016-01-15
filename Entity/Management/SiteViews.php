<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\ORM\Mapping as ORM;

/**
 * SiteViews
 *
 * @ORM\Entity
 * @ORM\Table(name="site_views")
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\SiteViewsRepository")
 */
class SiteViews
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
     * @ORM\Column(name="username_or_user_ip", type="string", length=80)
     */
    private $usernameOrUserIp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_visit", type="datetime")
     */
    private $lastVisit;

    /**
     * @var array
     *
     * @ORM\Column(name="from_url", type="string", length=80, nullable=true)
     */
    private $from_url;

    /**
     * @var array
     *
     * @ORM\Column(name="where_url", type="string", length=80, nullable=true)
     */
    private $where_url;

    /**
     * @var array
     *
     * @ORM\Column(name="content", type="json_array")
     */
    private $content;


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
     * Set usernameOrUserIp
     *
     * @param string $usernameOrUserIp
     * @return SiteViews
     */
    public function setUsernameOrUserIp($usernameOrUserIp)
    {
        $this->usernameOrUserIp = $usernameOrUserIp;

        return $this;
    }

    /**
     * Get usernameOrUserIp
     *
     * @return string
     */
    public function getUsernameOrUserIp()
    {
        return $this->usernameOrUserIp;
    }

    /**
     * Set lastVisit
     *
     * @param \DateTime $lastVisit
     * @return SiteViews
     */
    public function setLastVisit($lastVisit)
    {
        $this->lastVisit = $lastVisit;

        return $this;
    }

    /**
     * Get lastVisit
     *
     * @return \DateTime
     */
    public function getLastVisit()
    {
        return $this->lastVisit;
    }

    /**
     * Set from_url
     *
     * @param array $from_url
     * @return SiteViews
     */
    public function setFromUrl($from_url)
    {
        $this->from_url = $from_url;

        return $this;
    }

    /**
     * Get from_url
     *
     * @return array
     */
    public function getFromUrl()
    {
        return $this->from_url;
    }

    /**
     * @param string $where_url
     * @return $this
     */
    public function setWhereUrl($where_url)
    {
        $this->where_url = $where_url;

        return $this;
    }

    /**
     * @return array
     */
    public function getWhereUrl()
    {
        return $this->where_url;
    }

    /**
     * Set content
     *
     * @param array $content
     * @return SiteViews
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
}
