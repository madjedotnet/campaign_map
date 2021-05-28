<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArmiesRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ArmiesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"read:army"}},
 *  denormalizationContext={"groups"={"write:army"}},
 *  collectionOperations={"get"},
 *  itemOperations={"get"}
 * )
 */
class Armies
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:tile", "write:tile", "read:army", "write:army"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read:tile", "read:army", "write:army"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=WarhammerArmies::class, inversedBy="armies")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:army", "write:army"})
     */
    private $warhammerArmy;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="armies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Maps::class, inversedBy="armies")
     */
    private $map;

    /**
     * @ORM\OneToMany(targetEntity=Tiles::class, mappedBy="army")
     */
    private $tiles;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $color;

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

    public function getWarhammerArmy(): ?WarhammerArmies
    {
        return $this->warhammerArmy;
    }

    public function setWarhammerArmy(?WarhammerArmies $warhammerArmy): self
    {
        $this->warhammerArmy = $warhammerArmy;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMap(): ?Maps
    {
        return $this->map;
    }

    public function setMap(?Maps $map): self
    {
        $this->map = $map;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

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
            $tile->setArmy($this);
        }

        return $this;
    }

    public function removeTile(Tiles $tile): self
    {
        if ($this->tiles->removeElement($tile)) {
            // set the owning side to null (unless already changed)
            if ($tile->getArmy() === $this) {
                $tile->setArmy(null);
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
    //     return $this->name;
    //     // to show the id of the Category in the select
    //     // return $this->id;
    // }
}
