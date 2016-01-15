<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\ORM\EntityRepository;

/**
 * DailyStatisticRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DailyStatisticRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function clickStatisticDay()
    {
        $date = '2015';
        $click = $this->createQueryBuilder('c')
            ->where('c.atDate LIKE :date')
            ->setParameter('date', '%'.$date.'%')
            ->groupBy('c.atDate')
            ->getQuery()
            ->getResult();

        return $click;
    }
}