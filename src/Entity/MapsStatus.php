<?php

namespace App\Entity;

use App\Repository\MapsStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MapsStatusRepository::class)
 */
class MapsStatus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=Maps::class, mappedBy="map_status")
     */
    private $maps;

    public function __construct()
    {
        $this->maps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection|Maps[]
     */
    public function getMaps(): Collection
    {
        return $this->maps;
    }

    public function addMap(Maps $map): self
    {
        if (!$this->maps->contains($map)) {
            $this->maps[] = $map;
            $map->setMapStatus($this);
        }

        return $this;
    }

    public function removeMap(Maps $map): self
    {
        if ($this->maps->removeElement($map)) {
            // set the owning side to null (unless already changed)
            if ($map->getMapStatus() === $this) {
                $map->setMapStatus(null);
            }
        }

        return $this;
    }
}
