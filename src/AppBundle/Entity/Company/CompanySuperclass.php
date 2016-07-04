<?php

namespace AppBundle\Entity\Company;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
class CompanySuperclass
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 15,
     *      minMessage = "assert.min_error_msg",
     *      maxMessage = "assert.max_error_msg")
     *
     * @ORM\Column(name="name", type="string", length=15, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "assert.min_error_msg",
     *      maxMessage = "assert.max_error_msg")
     *
     * @ORM\Column(name="dba_name", type="string", length=50)
     */
    private $dbaName;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 10,
     *      max = 255,
     *      minMessage = "assert.min_error_msg",
     *      maxMessage = "assert.max_error_msg")
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "assert.min_error_msg",
     *      maxMessage = "assert.max_error_msg")
     *
     * @ORM\Column(name="address_1", type="string", length=50)
     */
    private $address1;

    /**
     * @var string
     *
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "assert.min_error_msg",
     *      maxMessage = "assert.max_error_msg")
     *
     * @ORM\Column(name="address_2", type="string", length=50, nullable=true)
     */
    private $address2;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = "assert.min_error_msg",
     *      maxMessage = "assert.max_error_msg")
     *
     * @ORM\Column(name="zip", type="string", length=20)
     */
    private $zip;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = "assert.min_error_msg",
     *      maxMessage = "assert.max_error_msg")
     *
     * @ORM\Column(name="city", type="string", length=20)
     */
    private $city;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = "assert.min_error_msg",
     *      maxMessage = "assert.max_error_msg")
     *
     * @ORM\Column(name="country", type="string", length=20)
     */
    private $country;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = "assert.min_error_msg",
     *      maxMessage = "assert.max_error_msg")
     *
     * @ORM\Column(name="vat_number", type="string", length=20, unique=true)
     */
    private $VATnumber;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 15,
     *      minMessage = "assert.min_error_msg",
     *      maxMessage = "assert.max_error_msg",
     *      groups={"NoPasswordRegistration"})
     *
     * @Assert\Regex(
     *     pattern="/^[0-9]*$/",
     *     message="assert.phone_error_msg")
     *
     * @ORM\Column(name="telephone", type="string", length=20)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;


    /**
     * @ORM\PrePersist
     */
    public function preUpdate()
    {

        if (null == $this->createdAt) {
            $this->createdAt = new DateTime();
            $this->updatedAt = new DateTime();
        }
    }


    /**
     * Set name
     *
     * @param string $name
     * @return CompanySuperclass
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set dbaName
     *
     * @param string $dbaName
     * @return CompanySuperclass
     */
    public function setDbaName($dbaName)
    {
        $this->dbaName = $dbaName;

        return $this;
    }

    /**
     * Get dbaName
     *
     * @return string
     */
    public function getDbaName()
    {
        return $this->dbaName;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return CompanySuperclass
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set address1
     *
     * @param string $address1
     * @return CompanySuperclass
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return CompanySuperclass
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set zip
     *
     * @param string $zip
     * @return CompanySuperclass
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return CompanySuperclass
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return CompanySuperclass
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set VATnumber
     *
     * @param string $vATnumber
     * @return CompanySuperclass
     */
    public function setVATnumber($vATnumber)
    {
        $this->VATnumber = $vATnumber;

        return $this;
    }

    /**
     * Get VATnumber
     *
     * @return string
     */
    public function getVATnumber()
    {
        return $this->VATnumber;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return CompanySuperclass
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return CompanySuperclass
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
     * @return CompanySuperclass
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
     * Set slug
     *
     * @param string $slug
     * @return CompanySuperclass
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
