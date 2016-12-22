<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contact.
 *
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
     * Contact constructor.
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
     *
     * @return Contact
     */
    public function setName($name): Contact
    {
        $this->name = $name;

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
     * @return Contact
     */
    public function setType($type): Contact
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getDeals(): Collection
    {
        return $this->deals;
    }

    /**
     * @param mixed $deals
     *
     * @return Contact
     */
    public function setDeals($deals): Contact
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
     * @param User $user
     *
     * @return Contact
     */
    public function setUser(User $user): Contact
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Add deal.
     *
     * @param Deal $deal Deal
     *
     * @return Contact
     */
    public function addDeal(Deal $deal): Contact
    {
        $this->deals[] = $deal;

        return $this;
    }

    /**
     * Remove deal.
     *
     * @param Deal $deal Deal
     *
     * @return Contact
     */
    public function removeDeal(Deal $deal): Contact
    {
        $this->deals->removeElement($deal);

        return $this;
    }
}
