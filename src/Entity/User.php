<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @ORM\AttributeOverrides({
 *     @ORM\AttributeOverride(
 *         name="email",
 *         column=@ORM\Column(nullable=true)
 *     ),
 *     @ORM\AttributeOverride(
 *         name="emailCanonical",
 *         column=@ORM\Column(nullable=true, unique=false)
 *     )
 * })
 * @UniqueEntity("username", message="This username is already in use.")
 */
class User extends BaseUser
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups("user:read")
     */
    protected $id;

    /**
     * Unmapped - for password policy validation
     * @Assert\Regex(
     *     pattern="/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9!@#$%^&*()_]+){8,20}$/",
     *     message="Password must contain an uppercase alphabet (A-Z) and an lowercase alphabet (a-z) and a number (0-9) and a special character (!,@,#,$,* etc.), all the four"
     * )
     * @Groups({"user:write"})
     */
    protected $plainPassword;

    /**
     * @var array
     * Unmapped field to send additional API data in profile call
     * @Groups("user:read")
     */
    private $data;

    /**
     * @Groups("user:read")
     */
    protected $email;

    /**
     * Unmapped
     * Prevents doctrine lifecycle triggers
     * @var bool
     */
    private $disableLifecycleCallback = false;

    public function __construct()
    {
        parent::__construct();
        $this->data = array();
    }

    public function __toString()
    {
        $full_name = $this->getProfile() ? $this->getProfile()->__toString() : false;
        return $full_name ? "$full_name ({$this->username})" : $this->username;
    }

    public function getFullName()
    {
        return $this->getProfile() ? $this->getProfile()->__toString() : 'NULL';
    }

    /**
     * Get id.
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id.
     *
     * @param ?int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Hook on pre-persist operations.
     * @ORM\PrePersist()
     */
    public function prePersist(): void
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Hook on pre-update operations.
     * @ORM\PreUpdate()
     */
    public function preUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return \DateTime
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        return $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return \DateTime
     */
    public function setUpdatedAt(\DateTime $updatedAt = null)
    {
        return $this->updatedAt = $updatedAt;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function isDisableLifecycleCallback(): bool
    {
        return $this->disableLifecycleCallback;
    }

    /**
     * @param bool $disableLifecycleCallback
     */
    public function setDisableLifecycleCallback(bool $disableLifecycleCallback)
    {
        $this->disableLifecycleCallback = $disableLifecycleCallback;
    }
}
