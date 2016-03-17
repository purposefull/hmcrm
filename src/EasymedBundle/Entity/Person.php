<?php

namespace EasymedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Person.
 *
 * @ORM\Table(name="person")
 * @ORM\Entity()
 */
class Person extends ContactBase
{
    const STATUS_CUSTOMER = 1;

    const STATUS_PAST_CUSTOMER = 2;

    const STATUS_NON_CUSTOMER = 3;

    const STATUS_PROSPECT = 4;

    const STATUS_NON_PROSPECT = 5;

    const STATUS_LOST_PROSPECT = 6;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $companyName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $customerStatus;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $prospectStatus;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="persons")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\OneToOne(targetEntity="Contact", mappedBy="person", cascade={"all"}, orphanRemoval=true)
     */
    protected $contact;

    /**
     * @return string
     */
    public function getCustomerStatus()
    {
        return $this->customerStatus;
    }

    /**
     * @param string $customerStatus
     */
    public function setCustomerStatus($customerStatus)
    {
        $this->customerStatus = $customerStatus;
    }

    /**
     * @return string
     */
    public function getProspectStatus()
    {
        return $this->prospectStatus;
    }

    /**
     * @param string $prospectStatus
     */
    public function setProspectStatus($prospectStatus)
    {
        $this->prospectStatus = $prospectStatus;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns array of customer statuses.
     *
     * @return []
     */
    public static function valuesOfCustomerStatus()
    {
        return [
            self::STATUS_CUSTOMER      => 'Customer',
            self::STATUS_PAST_CUSTOMER => 'Past Customer',
            self::STATUS_NON_CUSTOMER  => 'Non Customer',
        ];
    }

    /**
     * Returns array of prospect statuses.
     *
     * @return []
     */
    public static function valuesOfProspectStatus()
    {
        return [
            self::STATUS_PROSPECT      => 'Prospect',
            self::STATUS_LOST_PROSPECT => 'Lost Prospect',
            self::STATUS_NON_PROSPECT  => 'Non Prospect',
        ];
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->getLastName().' '.$this->getFirstName();
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }
}
