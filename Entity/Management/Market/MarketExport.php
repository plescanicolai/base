<?php

namespace Feedify\BaseBundle\Entity\Management\Market;

use Doctrine\ORM\Mapping as ORM;
use Feedify\BaseBundle\Entity\Management\Language;

/**
 * MarketExport
 *
 * @ORM\Entity
 * @ORM\Table(name="market_export")})
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\Market\MarketExportRepository")
 */
class MarketExport
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="export_directory", type="string", length=64)
     */
    private $exportDirectory;

    /**
     * Example values : csv,txt,xml
     *
     * @ORM\Column(name="export_formats", type="string", length=100)
     */
    private $exportFormats;

    /**
     * @ORM\Column(name="export_documentation", type="string")
     */
    private $exportDocumentation;

    /**
     * @ORM\ManyToOne(targetEntity="Feedify\BaseBundle\Entity\Management\Language")
     * @ORM\JoinColumn(name="export_language_id", referencedColumnName="id", onDelete="RESTRICT", nullable=true)
     */
    private $exportLanguage;

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
     * Set exportDirectory
     *
     * @param string $exportDirectory
     * @return MarketExport
     */
    public function setExportDirectory($exportDirectory)
    {
        $this->exportDirectory = $exportDirectory;
    
        return $this;
    }

    /**
     * Get exportDirectory
     *
     * @return string
     */
    public function getExportDirectory()
    {
        return $this->exportDirectory;
    }

    /**
     * Set exportFormats
     *
     * @param string $exportFormats
     * @return MarketExport
     */
    public function setExportFormats($exportFormats)
    {
        $this->exportFormats = $exportFormats;
    
        return $this;
    }

    /**
     * Get exportFormats
     *
     * @return string
     */
    public function getExportFormats()
    {
        return $this->exportFormats;
    }

    /**
     * Set exportDocumentation
     *
     * @param string $exportDocumentation
     * @return MarketExport
     */
    public function setExportDocumentation($exportDocumentation)
    {
        $this->exportDocumentation = $exportDocumentation;

        return $this;
    }

    /**
     * Get exportDocumentation
     *
     * @return string
     */
    public function getExportDocumentation()
    {
        return $this->exportDocumentation;
    }

    /**
     * Set exportLanguage
     *
     * @param Language $exportLanguage
     * @return MarketExport
     */
    public function setExportLanguage(Language $exportLanguage = null)
    {
        $this->exportLanguage = $exportLanguage;

        return $this;
    }

    /**
     * Get exportLanguage
     *
     * @return Language
     */
    public function getExportLanguage()
    {
        return $this->exportLanguage;
    }
}
