<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contact.
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity()
 */
class Contact extends Base
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Company", inversedBy="contacts")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    protected $company;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=255)
     */
    protected $type;

    /**
     * @ORM\OneToMany(targetEntity="Deal", mappedBy="contact")
     */
    protected $deals;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="contacts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->deals = new ArrayCollection();
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
     *
     * @return $this
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
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
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
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
     *
     * @return $this
     */
    public function setDeals($deals)
    {
        $this->deals = $deals;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        $name = $this->getCompany()->getName();

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
     *
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Add deal.
     *
     * @param Deal $deal Deal
     *
     * @return $this
     */
    public function addDeal(Deal $deal)
    {
        $this->deals[] = $deal;

        return $this;
    }

    /**
     * Remove deal.
     *
     * @param Deal $deal Deal
     */
    public function removeDeal(Deal $deal)
    {
        $this->deals->removeElement($deal);
    }
}
