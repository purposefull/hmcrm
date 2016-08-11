<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

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

    protected $emailService;

    protected $emailApiKey;

    protected $taskService;

    protected $taskApiKey;

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
