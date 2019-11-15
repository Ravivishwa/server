<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Table(name="guest")
 * @ORM\Entity()
 */
class Guest
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"event:read", "event:write","sessionGuest:read","sessionGuest:write"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Groups({"event:read", "event:write","sessionGuest:read","sessionGuest:write"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     * @Groups({"event:read", "event:write","sessionGuest:read","sessionGuest:write"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string",nullable=true)
     * @Groups({"event:read", "event:write" ,"sessionGuest:read","sessionGuest:write"})
     */
    private $headShotURL;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getHeadShotURL(): ?string
    {
        return $this->headShotURL;
    }

    public function setHeadShotURL(?string $headShotURL): self
    {
        $this->headShotURL = $headShotURL;

        return $this;
    }
}
