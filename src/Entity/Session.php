<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"session:read"}},
 *     denormalizationContext={"groups"={"session:write"}},
 * )
 * @ORM\Table(name="sessions")
 * @ORM\Entity()
 */
class Session
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"event:read", "event:write","sessionData:read", "sessionData:write","sessionGuest:read"})
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime", nullable=false)
     * @Groups({"event:read", "event:write","sessionData:read", "sessionData:write","sessionGuest:read" })
     */
    private $time;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

}
