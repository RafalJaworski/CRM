<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Company\Company;
use AppBundle\Entity\Ticket\Ticket;
use AppBundle\Helper\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BaseController extends Controller
{
    public function isPost(Request $request)
    {
        return $request->isMethod(Request::METHOD_POST);
    }

    public function isGet(Request $request)
    {
        return $request->isMethod(Request::METHOD_GET);
    }
    
    public function trans($phrase, $domain)
    {
        return $this->get('translator')->trans($phrase, [], $domain);
    }

    public function getCompany()
    {
        if($this->getUser()){
            return $this->getUser()->getCompany();
        }
    }

    public function checkResult($entity)
    {
        if(null != $entity){
            return $this->addFlash(Message::TYPE_WARNING,
                $this->get('translator')->trans('flash.message_not_exist', [], 'messages'));
        }
    }

    public function isArrayEmpty(Array $array)
    {
        if (empty($array)) {
            return $this->addFlash(Message::TYPE_DANGER,
                $this->get('translator')->trans('flash.message_empty', [], 'messages'));
        }
    }

    public function redirectAfterSuccess($route)
    {
        $this->addFlash(Message::TYPE_SUCCESS, $this->get('translator')->trans('flash.message_success', [], 'messages'));
        
        return $this->redirectToRoute($route);
    }
    
//    REPOSITORIES
    public function tickets()
    {
        return $this->getDoctrine()->getRepository(Ticket::class);
    }
}

