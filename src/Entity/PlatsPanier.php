<?php

namespace App\Entity;

use App\Entity\PlatsPanier;
use App\Repository\PlatsPanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlatsPanierRepository::class)
 */
class PlatsPanier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantité;

    /**
     * @ORM\ManyToOne(targetEntity=PlatsPanier::class, inversedBy="plats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plats;

    /**
     * @ORM\ManyToOne(targetEntity=PlatsPanier::class, inversedBy="panier")
     * @ORM\JoinColumn(nullable=false)
     */
    private $panier;

    /**
     * @ORM\Column(type="float")
     */
    private $Price;

    public function __construct()
    {
        $this->plats = new ArrayCollection();
        $this->panier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantité(): ?int
    {
        return $this->quantité;
    }

    public function setQuantité(int $quantité): self
    {
        $this->quantité = $quantité;

        return $this;
    }

    public function getPlats(): ?self
    {
        return $this->plats;
    }

    public function setPlats(?self $plats): self
    {
        $this->plats = $plats;

        return $this;
    }

    public function addPlat(self $plat): self
    {
        if (!$this->plats->contains($plat)) {
            $this->plats[] = $plat;
            $plat->setPlats($this);
        }

        return $this;
    }

    public function removePlat(self $plat): self
    {
        if ($this->plats->removeElement($plat)) {
            // set the owning side to null (unless already changed)
            if ($plat->getPlats() === $this) {
                $plat->setPlats(null);
            }
        }

        return $this;
    }

    public function getPanier(): ?self
    {
        return $this->panier;
    }

    public function setPanier(?self $panier): self
    {
        $this->panier = $panier;

        return $this;
    }

    public function addPanier(self $panier): self
    {
        if (!$this->panier->contains($panier)) {
            $this->panier[] = $panier;
            $panier->setPanier($this);
        }

        return $this;
    }

    public function removePanier(self $panier): self
    {
        if ($this->panier->removeElement($panier)) {
            // set the owning side to null (unless already changed)
            if ($panier->getPanier() === $this) {
                $panier->setPanier(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }
}
