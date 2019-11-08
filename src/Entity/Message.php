<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     )
 * @ORM\Table(name="message")
 * @ORM\Entity()
 */
class Message
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sent_at", type="datetime", nullable=false)
     */
    private $sentAt;

    /**
     * @var Guest
     *
     * @ORM\ManyToOne(targetEntity="Guest")
     */
    private $guest;

    /**
     * @ORM\Column(name="message",type="string", nullable=true)
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSentAt(): \DateTime
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTime $sentAt = null)
    {
        return $this->sentAt = $sentAt;
    }


    public function getGuest(): ?Guest
    {
        return $this->guest;
    }

    public function setGuest(?Guest $guest): self
    {
        $this->guest = $guest;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

}
