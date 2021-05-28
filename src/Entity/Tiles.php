<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TilesRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TilesRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"read:tile"}},
 *  denormalizationContext={"groups"={"write:tile"}},
 *  collectionOperations={
 *      "get", 
 *      "post"},
 *  itemOperations={
 *      "get", 
 *      "put"}
 * )
 */

class Tiles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:tile", "write:tile"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Groups({"read:tile", "write:tile"})
     */
    private $coordinates;

    /**
     * @ORM\ManyToOne(targetEntity=WarhammerSceneries::class, inversedBy="tiles")
     * @Groups({"read:tile", "write:tile"})
     */
    private $scenery;

    /**
     * @ORM\ManyToOne(targetEntity=Maps::class, inversedBy="tiles")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:tile", "write:tile"})
     */
    private $map;

    /**
     * @ORM\ManyToOne(targetEntity=Armies::class, inversedBy="tiles")
     * @Groups({"read:tile", "write:tile"})
     */
    private $army;

    /**
     * @ORM\ManyToOne(targetEntity=Buildings::class, inversedBy="tiles")
     * @Groups({"read:tile", "write:tile"})
     */
    private $building;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoordinates(): ?string
    {
        return $this->coordinates;
    }

    public function setCoordinates(?string $coordinates): self
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    public function getScenery(): ?WarhammerSceneries
    {
        return $this->scenery;
    }

    public function setScenery(?WarhammerSceneries $scenery): self
    {
        $this->scenery = $scenery;

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

    public function getArmy(): ?Armies
    {
        return $this->army;
    }

    public function setArmy(?Armies $army): self
    {
        $this->army = $army;

        return $this;
    }

    public function getBuilding(): ?Buildings
    {
        return $this->building;
    }

    public function setBuilding(?Buildings $building): self
    {
        $this->building = $building;

        return $this;
    }

    // /**
    //  * To correct "Object of class App\Entity\Tiles could not be converted to string"
    //  * 
    //  */
    // public function __toString(){
    //     // to show the name of the Category in the select
    //     return $this->coordinates;
    //     // to show the id of the Category in the select
    //     // return $this->id;
    // }
}
