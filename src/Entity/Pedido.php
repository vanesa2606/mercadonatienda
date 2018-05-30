<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PedidoRepository")
 */
class Pedido
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cliente", inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PedidoProductoCantidad", mappedBy="pedido")
     */
    private $pedidoscantidad;

    public function __construct()
    {
        $this->pedidoscantidad = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * @return Collection|PedidoProductoCantidad[]
     */
    public function getPedidoscantidad(): Collection
    {
        return $this->pedidoscantidad;
    }

    public function addPedidoscantidad(PedidoProductoCantidad $pedidoscantidad): self
    {
        if (!$this->pedidoscantidad->contains($pedidoscantidad)) {
            $this->pedidoscantidad[] = $pedidoscantidad;
            $pedidoscantidad->setPedido($this);
        }

        return $this;
    }

    public function removePedidoscantidad(PedidoProductoCantidad $pedidoscantidad): self
    {
        if ($this->pedidoscantidad->contains($pedidoscantidad)) {
            $this->pedidoscantidad->removeElement($pedidoscantidad);
            // set the owning side to null (unless already changed)
            if ($pedidoscantidad->getPedido() === $this) {
                $pedidoscantidad->setPedido(null);
            }
        }

        return $this;
    }
}
