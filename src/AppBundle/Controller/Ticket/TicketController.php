<?php

namespace AppBundle\Controller\Ticket;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Company\Company;
use AppBundle\Entity\Ticket\Ticket;
use AppBundle\Form\Ticket\TicketType;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        return $this->render('ticket/new.html.twig', ['form' => $form]);
    }

    /**
     * @Route("/ticket/save", name="save_ticket")
     */
    public function saveAction(Request $request)
    {
        $form = $this->createForm(TicketType::class, new Ticket());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('ticket_manager')->saveTicket($form->getData());

            return $this->redirectAfterSuccess('admin_dashboard');
        }

        return $this->render('ticket/new.html.twig', ['form' => $form]);
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

        if ($this->isPost($request)) {
            return new JsonResponse(
                [
                    'content' => $this->renderView(':ticket:show.html.twig',
                        [
                            'ticket' => $ticket,
                            'company' => $company
                        ])
                ]);
        }
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

        return $this->render('ticket/new.html.twig', ['ticket' => $tickets, 'company' => $this->getCompany()]);
    }
}

