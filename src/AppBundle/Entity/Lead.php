<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lead.
 *
 * @author Yevgeniy Zholkevskiy <blackbullet@i.ua>
 *
 * @ORM\Table(name="lead")
 * @ORM\Entity()
 */
class Lead extends ContactBase
{
    const STATUS_NEW = 1;

    const STATUS_WORKING = 2;

    const STATUS_UNQUALIFIED = 3;

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
     * @ORM\Column(type="string", length=255, nullable=true)
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
    protected $leadStatus;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $product;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $source;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $building;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $event;

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * @param mixed $building
     */
    public function setBuilding($building)
    {
        $this->building = $building;
    }

    /**
     * @return mixed
     */
    public function getDeliveryDate()
    {
        return $this->deliveryDate;
    }

    /**
     * @param mixed $deliveryDate
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;
    }

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $deliveryDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $tariff;

    /**
     * @return mixed
     */
    public function getTariff()
    {
        return $this->tariff;
    }

    /**
     * @param mixed $tariff
     */
    public function setTariff($tariff)
    {
        $this->tariff = $tariff;
    }

//    /**
//     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="contacts")
//     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
//     */
//    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="leads")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
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
     *
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
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
     *
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
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
     *
     * @return $this
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
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
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getLeadStatus()
    {
        return $this->leadStatus;
    }

    /**
     * @param string $leadStatus
     *
     * @return $this
     */
    public function setLeadStatus($leadStatus)
    {
        $this->leadStatus = $leadStatus;

        return $this;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     *
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Returns array of statuses.
     *
     * @return []
     */
    public static function valuesOfStatus()
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_WORKING => 'Working',
            self::STATUS_UNQUALIFIED => 'Unqualified',
        ];
    }

    /**
     * Returns status name.
     *
     * @param int $statusKey
     *
     * @return string
     */
    public static function getStatusName($statusKey)
    {
        if (array_key_exists($statusKey, self::valuesOfStatus())) {
            $statusArray = self::valuesOfStatus();

            return $statusArray[$statusKey];
        }

        return false;
    }

    /**
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param string $product
     *
     * @return $this
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }
}
