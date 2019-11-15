<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\AddSessionGuests;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"sessionGuest:read"}},
 *     denormalizationContext={"groups"={"sessionGuest:write"}},
 *     collectionOperations={
 *         "get",
 *         "put",
 *         "add"={
 *             "method"="PUT",
 *             "path"="/session_guest/{session_id}",
 *             "controller"=AddSessionGuests::class,
 *              },
 *     }
 * )
 * @ORM\Table(name="session_guests")
 * @ApiFilter(SearchFilter::class, properties={"sessions.id"})
 * @ORM\Entity()
 */
class SessionGuest
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"sessionGuest:read", "sessionGuest:write"})
     */
    protected $id;


    /**
     * @var Session
     *
     * @ORM\ManyToOne(targetEntity="Session")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Groups({"event:read", "event:write","sessionGuest:read"})
     */
    private $session;

    /**
     * @var Guest
     *
     * @ORM\ManyToOne(targetEntity="Guest")
     * @ORM\JoinColumn(onDelete="CASCADE")
     * @Groups({"event:read", "event:write","sessionGuest:read"})
     */
    private $guest;

    public function getId(): ?int
    {
        return $this->id;
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
