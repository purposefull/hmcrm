<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Lead.
 *
 * @ORM\Entity()
 */
class Lead extends Base
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $zipCode;

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
    protected $status;

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
     * @var string
     *
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $mobilePhone;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $workPhone;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $region;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $country;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="leads")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $deliveryDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $tariff;

    /**
     * Lead constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return Lead
     */
    public function setEmail($email): Lead
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * @param string $mobilePhone
     *
     * @return Lead
     */
    public function setMobilePhone($mobilePhone): Lead
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     *
     * @return Lead
     */
    public function setRegion($region): Lead
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return string
     */
    public function getWorkPhone()
    {
        return $this->workPhone;
    }

    /**
     * @param string $workPhone
     *
     * @return Lead
     */
    public function setWorkPhone($workPhone): Lead
    {
        $this->workPhone = $workPhone;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return Lead
     */
    public function setAddress($address): Lead
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return Lead
     */
    public function setCity($city): Lead
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return Lead
     */
    public function setCountry($country): Lead
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     *
     * @return Lead
     */
    public function setEvent($event): Lead
    {
        $this->event = $event;

        return $this;
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
     *
     * @return Lead
     */
    public function setBuilding($building): Lead
    {
        $this->building = $building;

        return $this;
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
     *
     * @return Lead
     */
    public function setDeliveryDate($deliveryDate): Lead
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTariff()
    {
        return $this->tariff;
    }

    /**
     * @param mixed $tariff
     *
     * @return Lead
     */
    public function setTariff($tariff): Lead
    {
        $this->tariff = $tariff;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return Lead
     */
    public function setUser(User $user): Lead
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
     * @return Lead
     */
    public function setFirstName($firstName): Lead
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     *
     * @return Lead
     */
    public function setZipCode($zipCode): Lead
    {
        $this->zipCode = $zipCode;

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
     * @return Lead
     */
    public function setLastName($lastName): Lead
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
     * @return Lead
     */
    public function setCompanyName($companyName): Lead
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
     * @return Lead
     */
    public function setTitle($title): Lead
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return Lead
     */
    public function setStatus($status): Lead
    {
        $this->status = $status;

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
     * @return Lead
     */
    public function setSource($source): Lead
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
     * @return Lead
     */
    public function setProduct($product): Lead
    {
        $this->product = $product;

        return $this;
    }
}
