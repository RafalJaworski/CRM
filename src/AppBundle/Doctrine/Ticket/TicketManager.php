<?php

namespace AppBundle\Doctrine\Ticket;

use AppBundle\Entity\Ticket\Ticket;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class TicketManager
{
    private $em;
    private $token;

    public function __construct
    (
        EntityManager $em,
        TokenStorage $token
    )
    {
        $this->em = $em;
        $this->token = $token;
    }

    public function saveTicket(Ticket $ticket)
    {
        $this->em->persist($ticket);
        $this->em->flush();
    }
}

