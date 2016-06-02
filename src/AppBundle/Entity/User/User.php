<?php

namespace AppBundle\Entity\User;

use DateTime;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="`user`")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\User\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 15,
     *      minMessage = "First name is too short. At least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters")
     * @Assert\Regex(
     *     pattern="/^[A-Za-z]*$/",
     *     message="Your first name cannot contain numbers,spaces and special characters")
     *
     * @ORM\Column(name="first_name", type="string")
     */
    private $firstName;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "Last name is too short. At least {{ limit }} characters long",
     *      maxMessage = "Your last name cannot be longer than {{ limit }} characters")
     * @Assert\Regex(
     *     pattern="/^[A-Za-z]*$/",
     *     message="Your first name cannot contain numbers,spaces and special characters")
     *
     * @ORM\Column(name="last_name", type="string")
     */
    private $lastName;

    /**
     * @var integer
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 2,
     *      max = 15,
     *      minMessage = "Mobile is too short. At least {{ limit }} characters long",
     *      maxMessage = "Mobile cannot be longer than {{ limit }} characters")
     * @Assert\Regex(pattern="/^[0-9]*$/",
     *     message="Only digits 0-9")
     * @ORM\Column(name="mobile", type="string")
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
     * @ORM\PrePersist
     */
    public function preUpdate()
    {
        if ((null == $this->createdAt) and (null == $this->updatedAt)) {
            $this->createdAt = new DateTime();
            $this->updatedAt = new DateTime();
        }
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
}

