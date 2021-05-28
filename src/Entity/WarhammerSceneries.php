<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\WarhammerSceneriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=WarhammerSceneriesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"read:scenery"}},
 *  denormalizationContext={"groups"={"write:scenery"}},
 *  collectionOperations={"get"},
 *  itemOperations={"get"}
 * )
 */
class WarhammerSceneries
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:tile", "write:tile", "read:scenery", "write:scenery"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read:tile", "read:scenery", "write:scenery"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Tiles::class, mappedBy="scenery")
     * @Groups({"read:scenery", "write:scenery"})
     */
    private $tiles;

    public function __construct()
    {
        $this->tiles = new ArrayCollection();
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
            $tile->setScenery($this);
        }

        return $this;
    }

    public function removeTile(Tiles $tile): self
    {
        if ($this->tiles->removeElement($tile)) {
            // set the owning side to null (unless already changed)
            if ($tile->getScenery() === $this) {
                $tile->setScenery(null);
            }
        }

        return $this;
    }

    /**
     * To correct "Object of class App\Entity\WarhammerArmies could not be converted to string"
     * 
     */
    public function __toString(){
        // to show the name of the Category in the select
        return $this->name;
        // to show the id of the Category in the select
        // return $this->id;
    }
}
