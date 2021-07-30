<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetalleRepository")
 */
class Detalle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombre;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true )
     */
    private $valor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Presupuesto", inversedBy="detalles", cascade={"persist"})
     */
    private $presupuesto;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DetallePresupuesto", inversedBy="presupuestos", cascade={"persist"})
     */
    private $detallePresupuesto;    

    /**
      * @var \DateTime
      *
      * @ORM\Column(name="createdAt", type="datetime")
      * @Gedmo\Timestampable(on="create")
      */
    private $createdAt;
 
    /**
      * @var \DateTime
      *
      * @ORM\Column(name="updatedAt", type="datetime")
      * @Gedmo\Timestampable(on="update")
      * @Gedmo\Versioned
      */
    private $updatedAt;


    public function getId(): ?int
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

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(string $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getPresupuesto(): ?Presupuesto
    {
        return $this->presupuesto;
    }

    public function setPresupuesto(?Presupuesto $presupuesto): self
    {
        $this->presupuesto = $presupuesto;

        return $this;
    }

    public function getDetallePresupuesto(): ?DetallePresupuesto
    {
        return $this->detallePresupuesto;
    }

    public function setDetallePresupuesto(?DetallePresupuesto $detallePresupuesto): self
    {
        $this->detallePresupuesto = $detallePresupuesto;

        return $this;
    }
}
