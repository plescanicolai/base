<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\ORM\Mapping as ORM;

/**
 * DailyStatistic
 *
 * @ORM\Table(name="daily_statistic",options={"collate"="utf8_general_ci"})
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\DailyStatisticRepository")
 */
class DailyStatistic
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
     * @var integer
     *
     * @ORM\Column(name="total_clicks", type="integer")
     */
    private $totalClicks;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_orders", type="integer")
     */
    private $totalOrders;

    /**
     * @var array
     *
     * @ORM\Column(name="statistic_data", type="json_array")
     */
    private $statisticData;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="at_date", type="date")
     */
    private $atDate;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->atDate = new \DateTime();
        $this->statisticData = array();
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
     * Set statisticData
     *
     * @param array $statisticData
     * @return DailyStatistic
     */
    public function setStatisticData($statisticData)
    {
        $this->statisticData = $statisticData;
    
        return $this;
    }

    /**
     * Get statisticData
     *
     * @return array
     */
    public function getStatisticData()
    {
        return $this->statisticData;
    }

    /**
     * Set totalClicks
     *
     * @param integer $totalClicks
     * @return DailyStatistic
     */
    public function setTotalClicks($totalClicks)
    {
        $this->totalClicks = $totalClicks;

        return $this;
    }

    /**
     * Get totalClicks
     *
     * @return integer
     */
    public function getTotalClicks()
    {
        return $this->totalClicks;
    }

    /**
     * Set totalOrders
     *
     * @param integer $totalOrders
     * @return DailyStatistic
     */
    public function setTotalOrders($totalOrders)
    {
        $this->totalOrders = $totalOrders;

        return $this;
    }

    /**
     * Get totalOrders
     *
     * @return integer
     */
    public function getTotalOrders()
    {
        return $this->totalOrders;
    }

    /**
     * Set atDate
     *
     * @param \DateTime $atDate
     * @return DailyStatistic
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
}
