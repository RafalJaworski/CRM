<?php

namespace AppBundle\Entity\Company;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity as UniqueEntity;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Company\CompanyRepository")
 * @UniqueEntity(fields={"name","VATnumber"})
 */
class Company extends CompanySuperclass
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User\User", mappedBy="company")
     */
    private $employees;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", inversedBy="createdCompanies")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @ORM\ManyToMany(targetEntity="Department", inversedBy="companies")
     * @ORM\JoinTable(name="companies_departments")
     */
    private $departments;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ticket\Ticket", mappedBy="company")
     */
    private $tickets;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->employees = new \Doctrine\Common\Collections\ArrayCollection();
        $this->departments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add employees
     *
     * @param \AppBundle\Entity\User\User $employees
     * @return Company
     */
    public function addEmployee(\AppBundle\Entity\User\User $employees)
    {
        $this->employees[] = $employees;

        return $this;
    }

    /**
     * Remove employees
     *
     * @param \AppBundle\Entity\User\User $employees
     */
    public function removeEmployee(\AppBundle\Entity\User\User $employees)
    {
        $this->employees->removeElement($employees);
    }

    /**
     * Get employees
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User\User $createdBy
     * @return Company
     */
    public function setCreatedBy(\AppBundle\Entity\User\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \AppBundle\Entity\User\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Add departments
     *
     * @param \AppBundle\Entity\Company\Department $departments
     * @return Company
     */
    public function addDepartment(\AppBundle\Entity\Company\Department $departments)
    {
        $this->departments[] = $departments;

        return $this;
    }

    /**
     * Remove departments
     *
     * @param \AppBundle\Entity\Company\Department $departments
     */
    public function removeDepartment(\AppBundle\Entity\Company\Department $departments)
    {
        $this->departments->removeElement($departments);
    }

    /**
     * Get departments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDepartments()
    {
        return $this->departments;
    }

    /**
     * Add tickets
     *
     * @param \AppBundle\Entity\Ticket\Ticket $tickets
     * @return Company
     */
    public function addTicket(\AppBundle\Entity\Ticket\Ticket $tickets)
    {
        $this->tickets[] = $tickets;

        return $this;
    }

    /**
     * Remove tickets
     *
     * @param \AppBundle\Entity\Ticket\Ticket $tickets
     */
    public function removeTicket(\AppBundle\Entity\Ticket\Ticket $tickets)
    {
        $this->tickets->removeElement($tickets);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTickets()
    {
        return $this->tickets;
    }
}

