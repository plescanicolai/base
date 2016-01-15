<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\ORM\EntityRepository;

/**
 * CategoriesShoppingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoriesShoppingRepository extends EntityRepository
{
    /**
     * @param int $parent
     * @return array
     */
    public function getCategoriesByParent($parent)
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.parent = :parent')
            ->setParameter('parent', $parent)
            ->getQuery()
            ->getArrayResult();

        $categoryArray = array();
        foreach ($queryBuilder as $category) {
            $categoryArray[$category['id']] = $category['name'];
        }

        return $categoryArray;
    }
}
