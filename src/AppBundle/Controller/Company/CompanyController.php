<?php

namespace AppBundle\Controller\Company;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Company\Company;
use AppBundle\Form\Company\CompanyType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CompanyController extends BaseController
{
    /**
     *
     * ADMINISTRATOR DASHBOARD
     *
     * @Route("/dashboard", name="admin_dashboard")
     */
    public function dashboardAction()
    {
    }

    /**
     * @Route("/company/new", name="new_company")
     */
    public function newAction()
    {
        $form = $this->createForm(CompanyType::class, new Company());

        return $this->showView('company/new.html.twig', $form);
    }

    /**
     * @Route("/company/save", name="save_company")
     */
    public function saveAction(Request $request)
    {
        $form = $this->handleForm(CompanyType::class, new Company(), $request);

        if ($form->isValid()) {
            $this->get('company_manager')->saveCompany($form->getData());

            return $this->redirectAfterSuccess('admin_dashboard');
        }

        return $this->showView('company/new.html.twig', $form);
    }
}

