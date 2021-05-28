<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MapsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MapsRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"read:map"}},
 *  denormalizationContext={"groups"={"write:map"}},
 *  collectionOperations={"get"},
 *  itemOperations={"get"}
 * )
 */
class Maps
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:tile", "write:tile", "read:map", "write:map"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read:tile", "read:map", "write:map"})
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:tile", "read:map", "write:map"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:tile", "read:map", "write:map"})
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=Armies::class, mappedBy="map")
     * @Groups({"read:tile", "read:map", "write:map"})
     */
    private $armies;

    /**
     * @ORM\OneToMany(targetEntity=Tiles::class, mappedBy="map", orphanRemoval=true)
     * @Groups({"read:map", "write:map"})
     */
    private $tiles;

    /**
     * @ORM\ManyToOne(targetEntity=MapsStatus::class, inversedBy="maps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $map_status;

    public function __construct()
    {
        $this->armies = new ArrayCollection();
        $this->tiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|Armies[]
     */
    public function getArmies(): Collection
    {
        return $this->armies;
    }

    public function addArmy(Armies $army): self
    {
        if (!$this->armies->contains($army)) {
            $this->armies[] = $army;
            $army->setMap($this);
        }

        return $this;
    }

    public function removeArmy(Armies $army): self
    {
        if ($this->armies->removeElement($army)) {
            // set the owning side to null (unless already changed)
            if ($army->getMap() === $this) {
                $army->setMap(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tiles[]
     */
    public function getTiles(): Collection
    {
        return $this->tiles;
    }

    public function addTile(Tiles $tile): self
    {
        if (!$this->tiles->contains($tile)) {
            $this->tiles[] = $tile;
            $tile->setMap($this);
        }

        return $this;
    }

    public function removeTile(Tiles $tile): self
    {
        if ($this->tiles->removeElement($tile)) {
            // set the owning side to null (unless already changed)
            if ($tile->getMap() === $this) {
                $tile->setMap(null);
            }
        }

        return $this;
    }

    // /**
    //  * To correct "Object of class App\Entity\WarhammerArmies could not be converted to string"
    //  * 
    //  */
    // public function __toString(){
    //     // to show the name of the Category in the select
    //     return $this->title;
    //     // to show the id of the Category in the select
    //     // return $this->id;
    // }

    public function getMapStatus(): ?MapsStatus
    {
        return $this->map_status;
    }

    public function setMapStatus(?MapsStatus $map_status): self
    {
        $this->map_status = $map_status;

        return $this;
    }
}
