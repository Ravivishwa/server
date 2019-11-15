<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\GetSessionGuests;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
/**
 * @ApiResource(
 *     collectionOperations={
 *         "get",
 *         "post",
 *         "event_session"={
 *             "method"="GET",
 *             "path"="/event_session/{eventId}",
 *             "controller"=GetSessionGuests::class,
 *              },
 *          "event"={
 *             "method"="GET",
 *             "path"="/event_session",
 *             "controller"=GetSessionGuests::class,
 *              }
 *     }
 * )
 * @ORM\Table(name="event_guests")
 * @ORM\Entity()
 */
class EventGuest
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
     * @var Guest
     *
     * @ORM\ManyToOne(targetEntity="Guest")
     * @Groups({"event:read", "event:write"})
     */
    private $guest;

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

    public function getGuest(): ?Guest
    {
        return $this->guest;
    }

    public function setGuest(?Guest $guest): self
    {
        $this->guest = $guest;

        return $this;
    }

}
