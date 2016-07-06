<?php

namespace AppBundle\Repository\User;

use AppBundle\Entity\Company\Company;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 */
class UserRepository extends EntityRepository
{
    public function companyUsersArray(Company $company)
    {
        return $this->createQueryBuilder('u')
            ->select(['u.id,u.firstName'])
            ->where('u.company = :company')
            ->orderBy('u.username', Criteria::ASC)
            ->setParameter('company', $company)
            ->getQuery()
            ->getResult();
    }
}

