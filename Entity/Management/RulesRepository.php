<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * RulesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RulesRepository extends EntityRepository
{
    /**
     * @param int $clientId
     * @return array
     */
    public function getRulesByClientId($clientId)
    {
        return $this->createQueryBuilder('r')
            ->join('r.filter', 'f', Join::WITH, 'f.clientId = :clientId')
            ->setParameter('clientId', $clientId)
            ->orderBy('r.weight', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param null|int $clientId
     * @param null|int $ruleId
     * @return array
     */
    public function getActiveRules($clientId = null, $ruleId = null)
    {
        $queryBuilder = $this->createQueryBuilder('r')
            ->where('r.active = 1')
            ->orderBy('r.weight', 'DESC');

        if ($clientId) {
            $queryBuilder
                ->join('r.filter', 'f', Join::WITH, 'f.clientId = :clientId')
                ->setParameter('clientId', $clientId);
        }

        if ($ruleId) {
            $queryBuilder
                ->andWhere('r.id = :ruleId')
                ->setParameter('ruleId', $ruleId);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * @param int $clientId
     * @return int
     */
    public function getMaxWeight($clientId)
    {
        $queryBuilder = $this
            ->createQueryBuilder('r')
            ->join('r.filter', 'f', Join::WITH, 'f.clientId = :clientId')
            ->setParameter('clientId', $clientId)
            ->orderBy('r.weight', 'DESC')
            ->setMaxResults(1)
            ->getQuery();

        try {
            $rules = $queryBuilder->getSingleResult();

            return $rules->getWeight();
        } catch (\Exception $e) {
            return 0;
        }
    }
}
