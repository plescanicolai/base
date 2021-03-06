<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * MarketRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MarketRepository extends EntityRepository
{
    /**
     * @param string $search
     * @return array
     */
    public function getActiveMarkets($search = '')
    {
        $queryBuilder = $this->createQueryBuilder('m')
            ->select('m, md')
            ->leftJoin('m.descriptions', 'md', Join::WITH, 'md.language = 3')
            ->where('m.isActive = :isActive')
            ->setParameter('isActive', true);

        if (!empty($search)) {
            $queryBuilder
                ->andWhere('m.name LIKE :search')
                ->setParameter('search', '%'.$search.'%');
        }

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param int $languageId
     * @return array
     */
    public function getMarketsWithLanguage($languageId = 3)
    {
        return $this->createQueryBuilder('m')
            ->select('m, md')
            ->leftJoin('m.descriptions', 'md', Join::WITH, 'md.language = :language')
            ->setParameter('language', $languageId)
            ->where('m.isActive = 1')
            ->orderBy('m.name')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $languageId
     * @return array
     */
    public function getCountriesWithMarketsByLanguage($languageId)
    {
        return $this->createQueryBuilder('m')
            ->select('DISTINCT c.id, cd.name')
            ->leftJoin('m.country', 'c')
            ->leftJoin('c.descriptions', 'cd')
            ->where('cd.languageId = :languageId')
            ->setParameter('languageId', $languageId)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param array $marketsId
     * @return array
     */
    public function getMarketsById($marketsId)
    {
        return $this->createQueryBuilder('m')
            ->select('m, field(m.id, :marketsId) as HIDDEN field')
            ->where('m.id IN (:marketsId)')
            ->setParameter('marketsId', $marketsId ?: array(0), Connection::PARAM_INT_ARRAY)
            ->orderBy('field')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    public function getMarketsName()
    {
        $queryBuilder = $this->createQueryBuilder('m')
            ->select('m.id, m.name')
            ->getQuery()
            ->getResult();

        $markets = array();
        foreach ($queryBuilder as $market) {
            $markets[$market['id']] = $market['name'];
        }

        return $markets;
    }
}
