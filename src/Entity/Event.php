<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\AddNewEvent;
use App\Controller\EventController;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"event:read"}},
 *     denormalizationContext={"groups"={"event:write"}},
 *     collectionOperations={
 *         "get",
 *         "post",
 *         "add"={
 *             "method"="POST",
 *             "path"="/add_event",
 *             "controller"=AddNewEvent::class,
 *              },
 *         "event_content"={
 *             "method"="GET",
 *             "path"="/event",
 *             "controller"=EventController::class,
 *              },
 *     }
 * )
 * @ORM\Table(name="event")
 * @ORM\Entity()
 */
class Event
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"event:read", "event:write","event:collection","sessionData:read","sessionGuest:read"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Groups({"event:read", "event:write","event:collection","sessionData:read" })
     */
    private $location;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     * @Groups({"event:read", "event:write","event:collection","sessionData:read" })
     */
    private $date;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

}
