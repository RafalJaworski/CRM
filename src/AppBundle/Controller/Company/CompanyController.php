<?php

namespace AppBundle\Controller\Company;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Company\Company;
use AppBundle\Entity\User\User;
use AppBundle\Form\Company\CompanyType;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $company = $this->getUser()->getCompany();
        $this->denyAccessUnlessGranted(User::ROLE_ANYMAC_USER, $company, $this->trans('user_access.controller.denied', 'messages'));
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

    /**
     *
     * EMPLOYEES OF COMPANY USER IN NEW TICKET FORM (only for anymac staff)
     *
     * @Route("/compamy/users", name="company_users")
     */
    public function usersAction(Request $request)
    {
        $companyId = $request->request->get('companyId');
        $company = $this->getDoctrine()->getRepository(Company::class)->find($companyId);
        
        if($this->isPost($request)){
            $users = $this->getDoctrine()->getRepository(User::class)->companyUsersArray($company);

            return new JsonResponse(['users' => $users]);
        }
    }
}

