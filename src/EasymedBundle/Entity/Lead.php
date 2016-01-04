<?php
namespace EasymedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Doctor
 *
 * @ORM\Table(name="lead")
 * @ORM\Entity()
 */
class Lead extends Base
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */

    protected $companyName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */

    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */

    protected $leadStatus;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */

    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */

    protected $mobilePhone;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */

    protected $workPhone;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */

    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */

    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */

    protected $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */

    protected $region;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */

    protected $country;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */

    protected $tags;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */

    protected $source;

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
     * @return string
     */
    public function getLeadStatus()
    {
        return $this->leadStatus;
    }

    /**
     * @param string $leadStatus
     */
    public function setLeadStatus($leadStatus)
    {
        $this->leadStatus = $leadStatus;
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
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     */
    public function setMobilePhone($mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;
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
     */
    public function setWorkPhone($workPhone)
    {
        $this->workPhone = $workPhone;
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
     */
    public function setAddress($address)
    {
        $this->address = $address;
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
     */
    public function setCity($city)
    {
        $this->city = $city;
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
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
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
     */
    public function setRegion($region)
    {
        $this->region = $region;
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
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param string $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
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
     */
    public function setSource($source)
    {
        $this->source = $source;
    }
}
