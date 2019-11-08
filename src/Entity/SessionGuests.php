<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\GetSessionGuests;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"sessionGuests:read"}},
 *     denormalizationContext={"groups"={"sessionGuests:write"}},
 * )
 * @ORM\Table(name="session_guests")
 * @ApiFilter(SearchFilter::class, properties={"sessions.id"})
 * @ORM\Entity()
 */
class SessionGuests
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;


    /**
     * @var Session
     *
     * @ORM\ManyToOne(targetEntity="Session")
     * @Groups({"sessionGuests:read","sessionData:read","sessionGuests:write","session:read" })
     */
    private $sessions;

    /**
     * @var Guest
     *
     * @ORM\ManyToOne(targetEntity="Guest")
     * @Groups({ "sessionData:write","sessionData:read","sessionGuests:read","session:read" })
     */
    private $guest;

    public function getId(): ?int
    {
        return $this->id;
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

}
