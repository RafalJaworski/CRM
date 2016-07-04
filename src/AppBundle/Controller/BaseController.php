<?php

namespace AppBundle\Controller;


use AppBundle\Helper\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;

class BaseController extends Controller
{
    public function trans($phrase, $domain)
    {
        return $this->get('translator')->trans($phrase, [], $domain);
    }

    public function handleForm($form, $entity, $request)
    {
        $form = $this->createForm($form, $entity);
        $form->handleRequest($request);

        return $form;
    }

    public function redirectAfterSuccess($route)
    {
        $this->addFlash(Message::TYPE_SUCCESS, $this->get('translator')->trans(Message::MSG_SUCCESS));
        
        return $this->redirectToRoute($route);
    }


    public function showView($viewName, FormInterface $form = null, $resources = null)
    {
        if (null != $form) {
            $form = $form->createView();
        }

        return $this->render($viewName,
            [
                'resources' => $resources,
                'form' => $form,
            ]);
    }
}

