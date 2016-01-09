<?php
namespace EasymedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity()
 */
class Company extends ContactBase
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
     * @Assert\NotBlank()
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

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
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="companies")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCustomerStatus()
    {
        return $this->customerStatus;
    }

    /**
     * @param mixed $customerStatus
     */
    public function setCustomerStatus($customerStatus)
    {
        $this->customerStatus = $customerStatus;
    }

    /**
     * @return mixed
     */
    public function getProspectStatus()
    {
        return $this->prospectStatus;
    }

    /**
     * @param mixed $prospectStatus
     */
    public function setProspectStatus($prospectStatus)
    {
        $this->prospectStatus = $prospectStatus;
    }

    /**
     * Returns array of customer statuses
     *
     * @return array
     */
    public static function valuesOfCustomerStatus()
    {
        return array(
            self::STATUS_CUSTOMER => 'Customer',
            self::STATUS_PAST_CUSTOMER => 'Past Customer',
            self::STATUS_NON_CUSTOMER => 'Non Customer',
        );
    }

    /**
     * Returns array of prospect statuses
     *
     * @return array
     */
    public static function valuesOfProspectStatus()
    {
        return array(
            self::STATUS_PROSPECT => 'Prospect',
            self::STATUS_LOST_PROSPECT => 'Lost Prospect',
            self::STATUS_NON_PROSPECT => 'Non Prospect',
        );
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
}