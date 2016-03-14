<?php

namespace EasymedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MedCard.
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class MedCard
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="recommendation", type="string", length=255)
     */
    private $recommendation;

    /**
     * @var string
     *
     * @ORM\Column(name="intake", type="string", length=255)
     */
    private $intake;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set recommendation.
     *
     * @param string $recommendation
     *
     * @return MedCard
     */
    public function setRecommendation($recommendation)
    {
        $this->recommendation = $recommendation;

        return $this;
    }

    /**
     * Get recommendation.
     *
     * @return string
     */
    public function getRecommendation()
    {
        return $this->recommendation;
    }

    /**
     * Set intake.
     *
     * @param string $intake
     *
     * @return MedCard
     */
    public function setIntake($intake)
    {
        $this->intake = $intake;

        return $this;
    }

    /**
     * Get intake.
     *
     * @return string
     */
    public function getIntake()
    {
        return $this->intake;
    }
}
