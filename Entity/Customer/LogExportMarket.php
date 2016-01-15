<?php

namespace Feedify\BaseBundle\Entity\Customer;

use Doctrine\ORM\Mapping as ORM;

/**
 * LogExportMarket
 *
 * @ORM\Table(name="log_export")
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Customer\LogExportMarketRepository")
 */
class LogExportMarket
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
     * @ORM\Column(name="market_id", unique=true, type="integer")
     */
    private $marketId;

    /**
     * @ORM\Column(name="export_data", type="json_array")
     */
    private $exportData;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
     *
     */
    public function __construct()
    {
        $this->date = new \DateTime();
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
     * Set marketId
     *
     * @param integer $marketId
     * @return LogExportMarket
     */
    public function setMarketId($marketId)
    {
        $this->marketId = $marketId;

        return $this;
    }

    /**
     * Get marketId
     *
     * @return integer
     */
    public function getMarketId()
    {
        return $this->marketId;
    }

    /**
     * Set export data
     *
     * @param array $exportData
     * @return LogExportMarket
     */
    public function setExportData($exportData)
    {
        $this->exportData = $exportData;

        return $this;
    }

    /**
     * Get export data
     *
     * @return array
     */
    public function getExportData()
    {
        return $this->exportData;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return LogExportMarket
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
