<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\ORM\EntityRepository;

/**
 * SiteViewsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SiteViewsRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function getViewsLastThenDays()
    {
        $dateTime = new \DateTime();
        $queryBuilder = $this->createQueryBuilder('m')
            ->select('m')
            ->where('m.lastVisit >= :dateTime')
            ->setParameter('dateTime', $dateTime->modify('-2 week'))
            ->getQuery()
            ->getResult();

        return $queryBuilder;
    }
}
