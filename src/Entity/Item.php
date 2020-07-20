<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     */
    private $api_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $price_to_sell;

    /**
     * @ORM\OneToMany(targetEntity=Farm::class, mappedBy="item")
     */
    private $farms;

//    public function __construct()
//    {
//        $this->farms = new ArrayCollection();
//    }
    
    public function __construct()
    {
        $this->farms = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getApiId(): ?int
    {
        return $this->api_id;
    }

    public function setApiId(int $api_id): self
    {
        $this->api_id = $api_id;

        return $this;
    }

    public function getPriceToSell(): ?int
    {
        return $this->price_to_sell;
    }

    public function setPriceToSell(int $price_to_sell): self
    {
        $this->price_to_sell = $price_to_sell;

        return $this;
    }

    /**
     * @return Collection|Farm[]
     */
    public function getFarms(): Collection
    {
        return $this->farms;
    }

    public function addFarm(Farm $farm): self
    {
        if (!$this->farms->contains($farm)) {
            $this->farms[] = $farm;
            $farm->setItem($this);
        }

        return $this;
    }

    public function removeFarm(Farm $farm): self
    {
        if ($this->farms->contains($farm)) {
            $this->farms->removeElement($farm);
            // set the owning side to null (unless already changed)
            if ($farm->getItem() === $this) {
                $farm->setItem(null);
            }
        }

        return $this;
    }
    
    /**
     * Generates the magic method
     * 
     */
    public function __toString(){
        // to show the name of the Category in the select
        return $this->name;
        // to show the id of the Category in the select
        // return $this->id;
    }
}
