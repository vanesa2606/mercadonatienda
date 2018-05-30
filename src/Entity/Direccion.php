<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DireccionRepository")
 */
class Direccion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $direccioncliente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cliente", inversedBy="direcciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    public function getId()
    {
        return $this->id;
    }

    public function getDireccioncliente(): ?string
    {
        return $this->direccioncliente;
    }

    public function setDireccioncliente(string $direccioncliente): self
    {
        $this->direccioncliente = $direccioncliente;

        return $this;
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
}
