<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Wave
 *
 * @ORM\Table(name="wave")
 * @ORM\Entity
 * @ApiResource()
 */
class Wave
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer",length=11)
     * @ORM\Id
     */
    protected $id;

    /**
     * @ORM\Column(name="filename",type="string", nullable=true,length=90)
     */
    private $filename;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(name="file_creation_time", type="datetime", nullable=true)
     */
    private $fileCreationTime;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(name="wave_time", type="datetime", nullable=true)
     */
    private $waveTime;

    /**
     * @var string|null
     *
     * @ORM\Column(name="meta_data", type="json",nullable=true)
     *
     */
    private $metaData;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="hls_generated", type="boolean", nullable=true, options={"default": false})
     */
    private $hlsGenerated = false;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getFileCreationTime(): ?\DateTimeInterface
    {
        return $this->fileCreationTime;
    }

    public function setFileCreationTime(\DateTimeInterface $fileCreationTime): self
    {
        $this->fileCreationTime = $fileCreationTime;

        return $this;
    }

    public function getWaveTime(): ?\DateTimeInterface
    {
        return $this->waveTime;
    }

    public function setWaveTime(\DateTimeInterface $waveTime): self
    {
        $this->waveTime = $waveTime;

        return $this;
    }

    public function getMetaData()
    {
        return $this->metaData;
    }

    public function setMetaData($metaData): self
    {
        $this->metaData = $metaData;

        return $this;
    }

    public function getHlsGenerated(): ?bool
    {
        return $this->hlsGenerated;
    }

    public function setHlsGenerated(?bool $hlsGenerated): self
    {
        $this->$hlsGenerated = $hlsGenerated;

        return $this;
    }
}