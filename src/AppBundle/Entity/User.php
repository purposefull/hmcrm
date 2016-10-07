<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $emailService;

    /**
     * @var string
     *
     * @Assert\Ip
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $emailServer;

    /**
     * @return string
     */
    public function getEmailServer()
    {
        return $this->emailServer;
    }

    /**
     * @param string $emailServer
     */
    public function setEmailServer($emailServer)
    {
        $this->emailServer = $emailServer;
    }

    /**
     * @return string
     */
    public function getEmailLogin()
    {
        return $this->emailLogin;
    }

    /**
     * @param string $emailLogin
     */
    public function setEmailLogin($emailLogin)
    {
        $this->emailLogin = $emailLogin;
    }

    /**
     * @return string
     */
    public function getEmailPassword()
    {
        return $this->emailPassword;
    }

    /**
     * @param string $emailPassword
     */
    public function setEmailPassword($emailPassword)
    {
        $this->emailPassword = $emailPassword;
    }

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $emailLogin;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $emailPassword;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $emailServiceAuto;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $emailApiKey;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $taskService;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $taskApiKey;

    /**
     * @return string
     */
    public function getEmailServiceAuto()
    {
        return $this->emailServiceAuto;
    }

    /**
     * @param string $emailServiceAuto
     */
    public function setEmailServiceAuto($emailServiceAuto)
    {
        $this->emailServiceAuto = $emailServiceAuto;
    }

    /**
     * @return mixed
     */
    public function getSmsService()
    {
        return $this->smsService;
    }

    /**
     * @param mixed $smsService
     */
    public function setSmsService($smsService)
    {
        $this->smsService = $smsService;
    }

    /**
     * @return mixed
     */
    public function getSmsApiKey()
    {
        return $this->smsApiKey;
    }

    /**
     * @param mixed $smsApiKey
     */
    public function setSmsApiKey($smsApiKey)
    {
        $this->smsApiKey = $smsApiKey;
    }

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $smsService;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $smsApiKey;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Lead", mappedBy="user")
     */
    protected $leads;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Contact", mappedBy="user")
     */
    protected $contacts;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Deal", mappedBy="user")
     */
    protected $deals;

    public function __construct()
    {
        parent::__construct();
        $this->leads = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->deals = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getEmailService()
    {
        return $this->emailService;
    }

    /**
     * @param mixed $emailService
     */
    public function setEmailService($emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * @return mixed
     */
    public function getTaskService()
    {
        return $this->taskService;
    }

    /**
     * @param mixed $taskService
     */
    public function setTaskService($taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @return mixed
     */
    public function getEmailApiKey()
    {
        return $this->emailApiKey;
    }

    /**
     * @param mixed $emailApiKey
     */
    public function setEmailApiKey($emailApiKey)
    {
        $this->emailApiKey = $emailApiKey;
    }

    /**
     * @return mixed
     */
    public function getTaskApiKey()
    {
        return $this->taskApiKey;
    }

    /**
     * @param mixed $taskApiKey
     */
    public function setTaskApiKey($taskApiKey)
    {
        $this->taskApiKey = $taskApiKey;
    }
}
