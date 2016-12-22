<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Deal.
 *
 * @ORM\Entity()
 */
class Deal extends Base
{
    const STAGE_INCOMING = 1;

    const STAGE_QUALIFIED = 2;

    const STAGE_QUOTE = 3;

    const STAGE_CLOSURE = 4;

    const STAGE_WON = 5;

    const STAGE_UNQUALIFIED = 6;

    const STAGE_LOST = 7;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Contact", inversedBy="deals")
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     */
    protected $contact;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="deals")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="deals")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $stage;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $value;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $currency;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $source;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $tags;

    /**
     * Deal constructor.
     */
    public function __construct()
    {
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
     * @return Deal
     */
    public function setName($name): Deal
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return Deal
     */
    public function setValue($value): Deal
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     *
     * @return Deal
     */
    public function setContact($contact): Deal
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return Deal
     */
    public function setCurrency($currency): Deal
    {
        $this->currency = $currency;

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
     * @return Deal
     */
    public function setSource($source): Deal
    {
        $this->source = $source;

        return $this;
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
     *
     * @return Deal
     */
    public function setTags($tags): Deal
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return string
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * @param string $stage
     *
     * @return Deal
     */
    public function setStage($stage): Deal
    {
        $this->stage = $stage;

        return $this;
    }

    /**
     * Returns array of stages.
     *
     * @return []
     */
    public static function valuesOfStage()
    {
        return [
            self::STAGE_INCOMING => 'Incoming',
            self::STAGE_QUALIFIED => 'Qualified',
            self::STAGE_QUOTE => 'Quote',
            self::STAGE_CLOSURE => 'Closure',
            self::STAGE_WON => 'Won',
            self::STAGE_UNQUALIFIED => 'Unqualified',
            self::STAGE_LOST => 'Lost',
        ];
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     *
     * @return Deal
     */
    public function setUser(User $user): Deal
    {
        $this->user = $user;

        return $this;
    }
}
