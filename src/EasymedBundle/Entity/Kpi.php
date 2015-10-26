<?php

namespace EasymedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kpi
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Kpi
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="sugar", type="integer")
     */
    private $sugar;

    /**
     * @var float
     *
     * @ORM\Column(name="cholesterol", type="float")
     */
    private $cholesterol;

    /**
     * @var integer
     *
     * @ORM\Column(name="heartRate", type="integer")
     */
    private $heartRate;

    /**
     * @var float
     *
     * @ORM\Column(name="pressureSystole", type="float")
     */
    private $pressureSystole;

    /**
     * @var integer
     *
     * @ORM\Column(name="pressureDiastole", type="integer")
     */
    private $pressureDiastole;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sugar
     *
     * @param integer $sugar
     *
     * @return Kpi
     */
    public function setSugar($sugar)
    {
        $this->sugar = $sugar;

        return $this;
    }

    /**
     * Get sugar
     *
     * @return integer
     */
    public function getSugar()
    {
        return $this->sugar;
    }

    /**
     * Set cholesterol
     *
     * @param float $cholesterol
     *
     * @return Kpi
     */
    public function setCholesterol($cholesterol)
    {
        $this->cholesterol = $cholesterol;

        return $this;
    }

    /**
     * Get cholesterol
     *
     * @return float
     */
    public function getCholesterol()
    {
        return $this->cholesterol;
    }

    /**
     * Set heartRate
     *
     * @param integer $heartRate
     *
     * @return Kpi
     */
    public function setHeartRate($heartRate)
    {
        $this->heartRate = $heartRate;

        return $this;
    }

    /**
     * Get heartRate
     *
     * @return integer
     */
    public function getHeartRate()
    {
        return $this->heartRate;
    }

    /**
     * Set pressureSystole
     *
     * @param float $pressureSystole
     *
     * @return Kpi
     */
    public function setPressureSystole($pressureSystole)
    {
        $this->pressureSystole = $pressureSystole;

        return $this;
    }

    /**
     * Get pressureSystole
     *
     * @return float
     */
    public function getPressureSystole()
    {
        return $this->pressureSystole;
    }

    /**
     * Set pressureDiastole
     *
     * @param integer $pressureDiastole
     *
     * @return Kpi
     */
    public function setPressureDiastole($pressureDiastole)
    {
        $this->pressureDiastole = $pressureDiastole;

        return $this;
    }

    /**
     * Get pressureDiastole
     *
     * @return integer
     */
    public function getPressureDiastole()
    {
        return $this->pressureDiastole;
    }
}
