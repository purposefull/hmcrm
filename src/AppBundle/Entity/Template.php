<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lead.
 *
 * @ORM\Table(name="template")
 * @ORM\Entity()
 */
class Template extends Base
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $code;

    /**
     * @ORM\OneToMany(targetEntity="Deal", mappedBy="product")
     */
    protected $deals;

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
}
