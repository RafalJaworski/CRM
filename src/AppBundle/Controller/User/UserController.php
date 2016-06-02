<?php

namespace AppBundle\Controller\User;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\User\User;
use AppBundle\Form\User\UserType;
use AppBundle\Helper\Message;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UserController extends BaseController
{
    /**
     * THIS CLASS OVERRIDE FOSUSERBUNDLE REGISTERACTION BY OVERRIDING ROUTING.
     * ADMINISTRATOR OF THE SYSTEM CREATE USER IN COMPANY BY HIMSELF ON ROUTE /user/register
     *
     * @Route("/register", name="fos_user_registration_register")
     */
    public function registerAction(Request $request)
    {
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
            $user->setCreatedBy($this->getUser());
            $userManager->updateUser($user);

            $this->addFlash(Message::TYPE_SUCCESS, $this->get('translator')->trans(Message::MSG_SUCCESS));
            return $this->redirectToRoute('fos_user_registration_register');
        }

        return $this->showView('@App/User/new.html.twig', 'new_user', $form);
    }
}

