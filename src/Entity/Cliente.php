<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClienteRepository")
 */
class Cliente
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pedido", mappedBy="cliente")
     */
    private $pedidos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Direccion", mappedBy="cliente")
     */
    private $direcciones;

    public function __construct()
    {
        $this->pedidos = new ArrayCollection();
        $this->direcciones = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection|Pedido[]
     */
    public function getPedidos(): Collection
    {
        return $this->pedidos;
    }

    public function addPedido(Pedido $pedido): self
    {
        if (!$this->pedidos->contains($pedido)) {
            $this->pedidos[] = $pedido;
            $pedido->setCliente($this);
        }

        return $this;
    }

    public function removePedido(Pedido $pedido): self
    {
        if ($this->pedidos->contains($pedido)) {
            $this->pedidos->removeElement($pedido);
            // set the owning side to null (unless already changed)
            if ($pedido->getCliente() === $this) {
                $pedido->setCliente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Direccion[]
     */
    public function getDirecciones(): Collection
    {
        return $this->direcciones;
    }

    public function addDireccione(Direccion $direccione): self
    {
        if (!$this->direcciones->contains($direccione)) {
            $this->direcciones[] = $direccione;
            $direccione->setCliente($this);
        }

        return $this;
    }

    public function removeDireccione(Direccion $direccione): self
    {
        if ($this->direcciones->contains($direccione)) {
            $this->direcciones->removeElement($direccione);
            // set the owning side to null (unless already changed)
            if ($direccione->getCliente() === $this) {
                $direccione->setCliente(null);
            }
        }

        return $this;
    }
}
