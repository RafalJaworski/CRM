<?php

namespace AppBundle\Controller\Company;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Company\Company;
use AppBundle\Entity\User\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CompanyCustomerController extends BaseController
{
    /**
     * ADMINISTRATOR DASHBOARD
     *
     * @Route("/customer/{slug}/admin", name="customer_admin_dashboard")
     * /**
     * @ParamConverter("company", class="AppBundle\Company\Company", options={"mapping": {"slug": "slug"}})
     */
    public function adminDashboardAction(Company $company)
    {
        $this->denyAccessUnlessGranted(User::ROLE_ADMIN, $company, $this->trans('user_access.controller.denied', 'messages'));
    }

    /**
     * User DASHBOARD
     *
     * @Route("/customer/{slug}/user", name="customer_user_dashboard")
     */
    public function userDashboardAction()
    {

    }
}

