<?php

namespace AppBundle\Controller\User;

use AppBundle\Form\User\UserPasswordType;
use AppBundle\Controller\BaseController;
use AppBundle\Entity\User\User;
use AppBundle\Form\User\UserType;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
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
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = new User();
        $form = $this->handleForm(UserType::class, $user, $request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
            $user->setCreatedBy($this->getUser());
            $this->get('fos_user.user_manager')->updateUser($user);

            return $this->redirectAfterSuccess('fos_user_registration_register');
        }

        return $this->showView('@App/User/new.html.twig', $form);
    }

    /**
     * THIS CLASS OVERRIDE FOSUSERBUNDLE COMFIRM BY OVERRIDING ROUTING.
     * THIS IS AFTER CLICKING LINK IN MAIL AFTER REGISTER USER
     *
     * @Route("/register/confirmed", name="fos_user_registration_confirmed")
     */
    public function confirmedAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw $this->createAccessDeniedException($this->trans('user.access_denied', 'messages'));
        }

        $form = $this->handleForm(UserPasswordType::class, $user, $request);
        if ($form->isValid()) {
            $this->get('fos_user.user_manager')->updateUser($user);

            return $this->redirectAfterSuccess('fos_user_registration_confirmed');
        }

        return $this->showView('@App/User/confirmed.html.twig', $form);
    }
}

