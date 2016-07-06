<?php

namespace AppBundle\Controller\Ticket;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Company\Company;
use AppBundle\Entity\Ticket\Ticket;
use AppBundle\Form\Ticket\TicketType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class TicketController extends BaseController
{

    /**
     * @Route("/ticket/new", name="new_ticket")
     */
    public function newAction()
    {
        $form = $this->createForm(TicketType::class, new Ticket());

        return $this->showView('ticket/new.html.twig', $form);
    }

    /**
     * @Route("/ticket/save", name="save_ticket")
     */
    public function saveAction(Request $request)
    {
        $form = $this->handleForm(TicketType::class, new Ticket(), $request);

        if ($form->isValid()) {
            $this->get('ticket_manager')->saveTicket($form->getData());

            return $this->redirectAfterSuccess('admin_dashboard');
        }

        return $this->showView('ticket/new.html.twig', $form);
    }

    /**
     * AJAX
     * 
     * @Route("/{slug}/ticket/{id}/show", name="show_ticket")
     * @ParamConverter("company", class="AppBundle:Company\Company", options={"mapping": {"slug": "slug"}})
     */
    public function showAction(Request $request, Ticket $ticket, Company $company)
    {
        $ticket = $this->tickets()->find($ticket);

       return $this->ajaxView(':ticket:show.html.twig',$request,$ticket,$company);
    }
    
    /**
     * ALL OPENED TICKETS
     *
     * @Route("/tickets/opened/all", name="all_opened_tickets")
     */
    public function allOpenedAction()
    {
        $tickets = $this->tickets()->allOpened();
        $this->isArrayEmpty($tickets);

        return $this->showView(':ticket:opened.html.twig', null, $tickets, $this->getCompany());

    }
}

