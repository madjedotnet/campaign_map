<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Repository\WarhammerArmiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=WarhammerArmiesRepository::class)
 */
class WarhammerArmies
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
     * @ORM\OneToMany(targetEntity=Armies::class, mappedBy="warhammerArmy")
     * 
     */
    private $armies;

    public function __construct()
    {
        $this->armies = new ArrayCollection();
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
            $army->setWarhammerArmy($this);
        }

        return $this;
    }

    public function removeArmy(Armies $army): self
    {
        if ($this->armies->removeElement($army)) {
            // set the owning side to null (unless already changed)
            if ($army->getWarhammerArmy() === $this) {
                $army->setWarhammerArmy(null);
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
