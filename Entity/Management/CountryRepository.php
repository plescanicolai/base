<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * CountryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CountryRepository extends EntityRepository
{
    /**
     * Get query for all countries with $languageId
     *
     * @param int $languageId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function queryCountryByLanguage($languageId)
    {
        return $this->createQueryBuilder('c')
            ->select('c, cd')
            ->innerJoin('c.descriptions', 'cd', Join::WITH, 'cd.languageId = :lang')
            ->setParameter('lang', $languageId)
            ->groupBy('cd.country')
            ->orderBy('cd.name');
    }
}
