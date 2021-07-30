<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PresupuestoRepository")
 */
class Presupuesto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @var string
    *
    * @ORM\Column(name="fecha", type="date", nullable=false)
    */
    protected $fecha;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Detalle", mappedBy="presupuesto", cascade={"persist"})
     */
    private $detalles;

    /**
    * @var string
    *
    * @ORM\Column(name="monto", type="string", nullable=true) 
    */
    protected $monto;

    /**
     * @ORM\ManyToOne(targetEntity=TipoActo::class, inversedBy="presupuestos")
     */
    private $acto;

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

    public function __construct()
    {
        $this->detalles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getDetalle(): ?string
    {
        return $this->detalle;
    }

    public function setDetalle(string $detalle): self
    {
        $this->detalle = $detalle;

        return $this;
    }

    public function getMonto(): ?string
    {
        return $this->monto;
    }

    public function setMonto(string $monto): self
    {
        $this->monto = $monto;

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

    /**
     * @return Collection|Detalle[]
     */
    public function getDetalles(): Collection
    {
        return $this->detalles;
    }

    public function addDetalle(Detalle $detalle): self
    {
        if (!$this->detalles->contains($detalle)) {
            $this->detalles[] = $detalle;
            $detalle->setPresupuesto($this);
        }

        return $this;
    }

    public function removeDetalle(Detalle $detalle): self
    {
        if ($this->detalles->removeElement($detalle)) {
            // set the owning side to null (unless already changed)
            if ($detalle->getPresupuesto() === $this) {
                $detalle->setPresupuesto(null);
            }
        }

        return $this;
    }

    public function getActo(): ?TipoActo
    {
        return $this->acto;
    }

    public function setActo(?TipoActo $acto): self
    {
        $this->acto = $acto;

        return $this;
    }
}
