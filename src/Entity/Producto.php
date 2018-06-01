<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductoRepository")
 */
class Producto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer")
     */
    private $precio;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categoria", inversedBy="productos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoria;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PedidoProductoCantidad", mappedBy="producto")
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

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
            $pedidoscantidad->setProducto($this);
        }

        return $this;
    }

    public function removePedidoscantidad(PedidoProductoCantidad $pedidoscantidad): self
    {
        if ($this->pedidoscantidad->contains($pedidoscantidad)) {
            $this->pedidoscantidad->removeElement($pedidoscantidad);
            // set the owning side to null (unless already changed)
            if ($pedidoscantidad->getProducto() === $this) {
                $pedidoscantidad->setProducto(null);
            }
        }

        return $this;
    }
}
