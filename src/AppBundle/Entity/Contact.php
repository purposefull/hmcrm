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
     * @var int
     *
     * @ORM\Column(type="integer", length=255)
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $name;

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
        $this->createdAt = new \DateTime();

    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
