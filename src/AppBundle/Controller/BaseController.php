<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;

class BaseController extends Controller
{
    /**
     *
     * This function is to render view. The reason for creating this class is to hide logic and make the code clear
     *
     * @param $viewName
     * @param $actionName
     * @param FormInterface|null $form
     * @param null $resource
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showView($viewName, $actionName, FormInterface $form = null, $resources = null, $referer = null)
    {
        if (null != $form) {
            $form = $form->createView();
        }

        return $this->render($viewName,
            [
                'controller_action' => $actionName,
                'resources' => $resources,
                'referer' => $referer,
                'form' => $form,
            ]);
    }
}

