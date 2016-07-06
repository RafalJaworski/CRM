<?php

namespace AppBundle\Repository\Ticket;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;

/**
 * TicketRepository
 *
 */
class TicketRepository extends EntityRepository
{
    /**
     *  ALL OPENED
     */
    public function allOpened()
    {
        return $this->createQueryBuilder('t')
            ->where('t.resolvedBy IS NULL')
            ->andWhere('t.resolvedAt IS NULL')
            ->orderBy('t.createdAt', Criteria::DESC)
            ->getQuery()
            ->getResult();
    }
}
