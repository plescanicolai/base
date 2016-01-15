<?php

namespace Feedify\BaseBundle\Entity\Management;

use Aws\Sns\Exception\NotFoundException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

/**
 * LanguagesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LanguageRepository extends EntityRepository
{
    /**
     * @param int|string $code
     * @return mixed
     */
    public function loadLanguageByCode($code)
    {
        $queryBuilder = $this
            ->createQueryBuilder('l')
            ->where('l.code = :code AND l.active = 1')
            ->setParameter('code', $code)
            ->getQuery();

        try {
            $language = $queryBuilder->getSingleResult();
        } catch (NoResultException $e) {
            $message = sprintf(
                'Unable to find an active language object identified by "%s".',
                $code
            );

            return;
        }

        return $language;
    }
}
