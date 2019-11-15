<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\EventDataController;
use Symfony\Component\Serializer\Annotation\Groups;

/**
  * @ApiResource(
  *     normalizationContext={"groups"={"event:read"}},
  *     denormalizationContext={"groups"={"event:write"}},
  *     collectionOperations={
  *         "get",
  *         "event_data"={
  *             "method"="GET",
  *             "path"="/event_data/{id}",
  *             "controller"=EventDataController::class,
  *              },
  *     }
  * )
 * @ORM\Table(name="event_sessions")
 * @ORM\Entity()
 */
class EventSession
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     */
    protected $id;

    /**
     * @var Event
     *
     * @ORM\ManyToOne(targetEntity="Event")
     */
    private $event;

    /**
     * @var Session
     *
     * @ORM\ManyToOne(targetEntity="Session")
     * @Groups({"event:read", "event:write","sessionData:read", "sessionData:write","sessionGuests:read" })
     */
    private $session;

    public function getId(): ?int


    {
        return $this->id;
    }

    /**
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * @param User $event
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;
    }
    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }

}
