<?php
namespace EasymedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity()
 */
class Contact extends Base
{
    const TYPE_PERSON = 1;

    const TYPE_COMPANY = 2;

    /**
     * @ORM\OneToOne(targetEntity="Person", inversedBy="contact")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    protected $person;

    /**
     * @ORM\OneToOne(targetEntity="Company", inversedBy="contact")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    protected $company;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", length=255)
     */
    protected $type;

    /**
     * @ORM\OneToMany(targetEntity="Deal", mappedBy="contact")
     */
    protected $deals;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User", inversedBy="contacts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @return mixed
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param mixed $person
     */
    public function setPerson($person)
    {
        $this->person = $person;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getDeals()
    {
        return $this->deals;
    }

    /**
     * @param mixed $deals
     */
    public function setDeals($deals)
    {
        $this->deals = $deals;
    }

    /**
     * @return string
     */
    public function getName()
    {
        $name = null;
        switch ($this->getType()) {
            case self::TYPE_PERSON:
                $name = $this->getPerson()->getFullName();
                break;
            case self::TYPE_COMPANY:
                $name = $this->getCompany()->getName();
                break;
        }

        return $name;
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