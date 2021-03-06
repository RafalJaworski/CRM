<?php

namespace AppBundle\Entity\User;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\User\UserRepository")
 */
class User extends BaseUser
{

    const ROLE_USER = 'ROLE_USER'; //customer user
    const ROLE_ADMIN = 'ROLE_ADMIN'; //customer admin
    const ROLE_ANYMAC_USER = 'ROLE_ANYMAC_USER';
    const ROLE_ANYMAC_ADMIN = 'ROLE_ANYMAC_ADMIN';


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank(groups={"NoPasswordRegistration"})
     * @Assert\Length(
     *      min = 3,
     *      max = 15,
     *      minMessage = "assert.min_error_msg",
     *      maxMessage = "assert.max_error_msg",
     *      groups={"NoPasswordRegistration"})
     * @Assert\Regex(
     *     pattern="/^[A-Za-z]*$/",
     *     message="assert.regex_error_msg",
     *     groups={"NoPasswordRegistration"})
     *
     * @ORM\Column(name="first_name", type="string")
     */
    private $firstName;

    /**
     * @var string
     * @Assert\NotBlank(groups={"NoPasswordRegistration"})
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = "assert.min_error_msg",
     *      maxMessage = "assert.max_error_msg",
     *      groups={"NoPasswordRegistration"})
     * @Assert\Regex(
     *     pattern="/^[A-Za-z]*$/",
     *     message="assert.regex_error_msg",
     *     groups={"NoPasswordRegistration"})
     *
     * @ORM\Column(name="last_name", type="string")
     */
    private $lastName;

    /**
     * @var integer
     * @Assert\Length(
     *      min = 7,
     *      max = 15,
     *      minMessage = "assert.min_error_msg",
     *      maxMessage = "assert.max_error_msg",
     *      groups={"registration"})
     * @Assert\Regex(pattern="/^[0-9]*$/",
     *      message="assert.phone_error_msg",
     *      groups={"NoPasswordRegistration"})
     * @ORM\Column(name="mobile", type="string", nullable=true)
     */
    private $mobile;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="createdUsers")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="createdBy")
     */
    private $createdUsers;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company\Company", inversedBy="employees")
     * @ORM\JoinColumn(name="employer_id", referencedColumnName="id")
     */
    private $company;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Company\Department", inversedBy="users")
     * @ORM\JoinTable(name="users_departments")
     */
    private $departments;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Company\Company", mappedBy="createdBy")
     */
    private $createdCompanies;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Company\Distributor", mappedBy="createdBy")
     */
    private $createdDistributors;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Company\Manufacturer", mappedBy="createdBy")
     */
    private $createdManufacturer;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Company\Supplier", mappedBy="createdBy")
     */
    private $createdSuppliers;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ticket\Ticket", mappedBy="createdBy")
     */
    private $createdTickets;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ticket\Ticket", mappedBy="assignedTo")
     */
    private $assignedTickets;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ticket\Ticket", mappedBy="resolvedBy")
     */
    private $resolvedTickets;


    public function __construct()
    {
        //parent must be called because of salt exception
        parent::__construct();
        $this->createdUsers = new ArrayCollection();
        $this->createdDistributors = new ArrayCollection();
        $this->createdCompanies = new ArrayCollection();
        $this->createdManufacturer = new ArrayCollection();
        $this->createdSuppliers = new ArrayCollection();
        $this->createdTickets = new ArrayCollection();
        $this->assignedTickets = new ArrayCollection();
        $this->resolvedTickets = new ArrayCollection();
        $this->departments = new ArrayCollection();
        
        if (null == $this->createdAt)
            $this->createdAt = new DateTime();

        if (null == $this->updatedAt)
            $this->updatedAt = new DateTime();

        if (null == $this->plainPassword) {
            $this->plainPassword = substr
            (str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
        }

    }

    public function __toString()
    {
        return $this->getFullname();
    }

    public function getFullname()
    {
        return $this->firstName.' '.$this->lastName;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }


    /**
     * Set mobile
     *
     * @param string $mobile
     * @return User
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User\User $createdBy
     * @return User
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
     * Add createdUsers
     *
     * @param \AppBundle\Entity\User\User $createdUsers
     * @return User
     */
    public function addCreatedUser(\AppBundle\Entity\User\User $createdUsers)
    {
        $this->createdUsers[] = $createdUsers;

        return $this;
    }

    /**
     * Remove createdUsers
     *
     * @param \AppBundle\Entity\User\User $createdUsers
     */
    public function removeCreatedUser(\AppBundle\Entity\User\User $createdUsers)
    {
        $this->createdUsers->removeElement($createdUsers);
    }

    /**
     * Get createdUsers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedUsers()
    {
        return $this->createdUsers;
    }

    /**
     * Set company
     *
     * @param \AppBundle\Entity\Company\Company $company
     * @return User
     */
    public function setCompany(\AppBundle\Entity\Company\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \AppBundle\Entity\Company\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Add createdCompanies
     *
     * @param \AppBundle\Entity\Company\Company $createdCompanies
     * @return User
     */
    public function addCreatedCompany(\AppBundle\Entity\Company\Company $createdCompanies)
    {
        $this->createdCompanies[] = $createdCompanies;

        return $this;
    }

    /**
     * Remove createdCompanies
     *
     * @param \AppBundle\Entity\Company\Company $createdCompanies
     */
    public function removeCreatedCompany(\AppBundle\Entity\Company\Company $createdCompanies)
    {
        $this->createdCompanies->removeElement($createdCompanies);
    }

    /**
     * Get createdCompanies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedCompanies()
    {
        return $this->createdCompanies;
    }

    /**
     * Add createdDistributors
     *
     * @param \AppBundle\Entity\Company\Company $createdDistributors
     * @return User
     */
    public function addCreatedDistributor(\AppBundle\Entity\Company\Company $createdDistributors)
    {
        $this->createdDistributors[] = $createdDistributors;

        return $this;
    }

    /**
     * Remove createdDistributors
     *
     * @param \AppBundle\Entity\Company\Company $createdDistributors
     */
    public function removeCreatedDistributor(\AppBundle\Entity\Company\Company $createdDistributors)
    {
        $this->createdDistributors->removeElement($createdDistributors);
    }

    /**
     * Get createdDistributors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedDistributors()
    {
        return $this->createdDistributors;
    }

    /**
     * Add createdManufacturer
     *
     * @param \AppBundle\Entity\Company\Manufacturer $createdManufacturer
     * @return User
     */
    public function addCreatedManufacturer(\AppBundle\Entity\Company\Manufacturer $createdManufacturer)
    {
        $this->createdManufacturer[] = $createdManufacturer;

        return $this;
    }

    /**
     * Remove createdManufacturer
     *
     * @param \AppBundle\Entity\Company\Manufacturer $createdManufacturer
     */
    public function removeCreatedManufacturer(\AppBundle\Entity\Company\Manufacturer $createdManufacturer)
    {
        $this->createdManufacturer->removeElement($createdManufacturer);
    }

    /**
     * Get createdManufacturer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedManufacturer()
    {
        return $this->createdManufacturer;
    }

    /**
     * Add createdSuppliers
     *
     * @param \AppBundle\Entity\Company\Supplier $createdSuppliers
     * @return User
     */
    public function addCreatedSupplier(\AppBundle\Entity\Company\Supplier $createdSuppliers)
    {
        $this->createdSuppliers[] = $createdSuppliers;

        return $this;
    }

    /**
     * Remove createdSuppliers
     *
     * @param \AppBundle\Entity\Company\Supplier $createdSuppliers
     */
    public function removeCreatedSupplier(\AppBundle\Entity\Company\Supplier $createdSuppliers)
    {
        $this->createdSuppliers->removeElement($createdSuppliers);
    }

    /**
     * Get createdSuppliers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreatedSuppliers()
    {
        return $this->createdSuppliers;
    }

    /**
     * Add createdTickets
     *
     * @param \AppBundle\Entity\Ticket\Ticket $createdTickets
     * @return User
     */
    public function addCreatedTicket(\AppBundle\Entity\Ticket\Ticket $createdTickets)
    {
        $this->createdTickets[] = $createdTickets;

        return $this;
    }

    /**
     * Remove createdTickets
     *
     * @param \AppBundle\Entity\Ticket\Ticket $createdTickets
     */
    public function removeCreatedTicket(\AppBundle\Entity\Ticket\Ticket $createdTickets)
    {
        $this->createdTickets->removeElement($createdTickets);
    }

    /**
     * Get createdTickets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCreatedTickets()
    {
        return $this->createdTickets;
    }

    /**
     * Add assignedTickets
     *
     * @param \AppBundle\Entity\Ticket\Ticket $assignedTickets
     * @return User
     */
    public function addAssignedTicket(\AppBundle\Entity\Ticket\Ticket $assignedTickets)
    {
        $this->assignedTickets[] = $assignedTickets;

        return $this;
    }

    /**
     * Remove assignedTickets
     *
     * @param \AppBundle\Entity\Ticket\Ticket $assignedTickets
     */
    public function removeAssignedTicket(\AppBundle\Entity\Ticket\Ticket $assignedTickets)
    {
        $this->assignedTickets->removeElement($assignedTickets);
    }

    /**
     * Get assignedTickets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAssignedTickets()
    {
        return $this->assignedTickets;
    }

    /**
     * Add resolvedTickets
     *
     * @param \AppBundle\Entity\Ticket\Ticket $resolvedTickets
     * @return User
     */
    public function addResolvedTicket(\AppBundle\Entity\Ticket\Ticket $resolvedTickets)
    {
        $this->resolvedTickets[] = $resolvedTickets;

        return $this;
    }

    /**
     * Remove resolvedTickets
     *
     * @param \AppBundle\Entity\Ticket\Ticket $resolvedTickets
     */
    public function removeResolvedTicket(\AppBundle\Entity\Ticket\Ticket $resolvedTickets)
    {
        $this->resolvedTickets->removeElement($resolvedTickets);
    }

    /**
     * Get resolvedTickets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResolvedTickets()
    {
        return $this->resolvedTickets;
    }

    /**
     * Add departments
     *
     * @param \AppBundle\Entity\Company\Department $departments
     * @return User
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
}

