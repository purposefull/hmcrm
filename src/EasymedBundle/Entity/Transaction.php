<?php

namespace EasymedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Transaction.
 *
 * @ORM\Table(name="transaction")
 * @ORM\Entity()
 */
class Transaction extends Base
{
    /**
     * @var int
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="date", type="integer", length=11)
     */
    protected $date;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    protected $status;

    /**
     * @var int
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="amount", type="integer", length=11)
     */
    protected $amount;

    /**
     * @ORM\ManyToOne(targetEntity="Patient", inversedBy="transactions")
     * @ORM\JoinColumn(name="patient_id", referencedColumnName="id")
     */
    protected $patient;

    /**
     * @return int
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param int $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * @param mixed $patient
     */
    public function setPatient($patient)
    {
        $this->patient = $patient;
    }
}
