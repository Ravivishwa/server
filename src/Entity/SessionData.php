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
 *     normalizationContext={"groups"={"sessionData:read"}},
 *     denormalizationContext={"groups"={"sessionData:write"}},
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
 * @ORM\Table(name="session_data")
 * @ORM\Entity()
 */
class SessionData
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
     * @Groups({"event:read", "event:write","sessionData:read", "sessionData:write","sessionGuests:read" })
     */
    private $event;

    /**
     * @var Session
     *
     * @ORM\ManyToOne(targetEntity="Session")
     * @Groups({"event:read", "event:write","sessionData:read", "sessionData:write","sessionGuests:read" })
     */
    private $sessions;

    /**
     * @var Guest
     *
     * @ORM\ManyToOne(targetEntity="Guest")
     * @Groups({"event:read", "event:write","sessionData:read", "sessionData:write","sessionGuests:read" })
     */
    private $guest;

    /**
     * @var SessionGuests
     *
     * @ORM\ManyToOne(targetEntity="SessionGuests")
     * @Groups({"event:read", "event:write","sessionData:read", "sessionData:write","sessionGuests:read" })
     */
    private $sessionGuests;

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
    public function getSessions(): ?Session
    {
        return $this->sessions;
    }

    public function setSessions(?Session $sessions): self
    {
        $this->sessions = $sessions;

        return $this;
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

    public function getSessionGuests(): ?SessionGuests
    {
        return $this->sessionGuests;
    }

    public function setSessionGuests(?SessionGuests $sessionGuests): self
    {
        $this->sessionGuests = $sessionGuests;

        return $this;
    }

}
