<?php

namespace Feedify\BaseBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Feedify\BaseBundle\Entity\Management\Language as LanguageEntity;

/**
 * Class Language
 * @package Feedify\BaseBundle\Service
 */
class Language
{
    /** @var string $activeLocale*/
    private $activeLocale;

    /** @var EntityManager $entityManager*/
    protected $entityManager;

    /**
     * @param Session       $session
     * @param EntityManager $entityManager
     * @param string        $defaultLocale
     */
    public function __construct($session, $entityManager, $defaultLocale = 'de')
    {
        $this->activeLocale = $session->get('_locale', $defaultLocale);
        $this->entityManager = $entityManager;
    }

    /**
     * @return LanguageEntity
     */
    public function getActiveLanguage()
    {
        return $this->entityManager
            ->getRepository('FeedifyBaseBundle:Management\Language')->loadLanguageByCode($this->activeLocale);
    }

    /**
     * @return array|LanguageEntity
     */
    public function getLanguages()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\Language')
            ->findBy(['active' => 1], ['sort' => 'ASC']);
    }

    /**
     * @return array
     */
    public function getLanguagesForDisplay()
    {
        $languages = $this->getLanguages();
        $return = array();
        /** @var LanguageEntity $language */
        foreach ($languages as $language) {
            $lang = new \stdClass();
            $lang->code = $language->getCode();
            $lang->name = $language->getName();
            $lang->icon = $language->getIcon();
            $lang->selected = ($lang->code == $this->activeLocale) ? 1 : 0;

            $return[] = $lang;
        }

        return $return;
    }
}
