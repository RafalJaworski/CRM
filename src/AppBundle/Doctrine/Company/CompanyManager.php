<?php

namespace AppBundle\Doctrine\Company;


use AppBundle\Entity\Company\Company;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class CompanyManager
{
    private $em;
    private $token;

    public function __construct
    (
        EntityManager $em,
        TokenStorage $token
    )
    {
        $this->em = $em;
        $this->token = $token;
    }

    public function saveCompany(Company $company)
    {
        $company->setCreatedBy($this->token->getToken()->getUser());
        $this->em->persist($company);
        $this->em->flush();
    }
}

