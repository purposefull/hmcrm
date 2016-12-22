<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Company
 *
 * @package AppBundle\Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompanyRepository")
 */
class Company extends Base
{
    /**
     * @var ArrayCollection|User[]
     *
     * @ORM\OneToMany(
     *     targetEntity="AppBundle\Entity\User",
     *     mappedBy="company",
     *     cascade={"all"}
     * )
     */
    private $users;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * Company constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Company
     */
    public function setName($name): Company
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @param User $user
     *
     * @return Company
     */
    public function addUser($user): Company
    {
        if (false === $this->users->contains($user)) {
            $this->users->add($user);

            $user->setCompany($this);
        }

        return $this;
    }

    /**
     * @param User $user
     *
     * @return Company
     */
    public function removeUser(User $user): Company
    {
        if (true === $this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->setCompany(null);
        }

        return $this;
    }
}
