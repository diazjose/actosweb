<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=App\Repository\CajaRepository::class)
 */
class Caja
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
    * @var string
    *
    * @ORM\Column(name="monto", type="string", nullable=false)
    * @Assert\NotBlank(message="Por favor ingrese Monto.") 
    */
    protected $monto;

    /**
    * @var string
    *
    * @ORM\Column(name="detalle", type="string", nullable=true)
    */
    protected $detalle;

    /**
     * @ORM\ManyToOne(targetEntity=TipoCaja::class, inversedBy="cajas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $concepto;

    /**
     * @ORM\ManyToOne(targetEntity=TipoPago::class, inversedBy="cajas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipoPago;

    /** 
     * @ORM\ManyToOne(targetEntity="Acto", inversedBy="pagos")
     * @ORM\JoinColumn(nullable=true)
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

    public function getConcepto(): ?TipoCaja
    {
        return $this->concepto;
    }

    public function setConcepto(?TipoCaja $concepto): self
    {
        $this->concepto = $concepto;

        return $this;
    }

    public function getPago(): ?Pago
    {
        return $this->pago;
    }

    public function setPago(?Pago $pago): self
    {
        $this->pago = $pago;

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

    public function getActo(): ?Acto
    {
        return $this->acto;
    }

    public function setActo(?Acto $acto): self
    {
        $this->acto = $acto;

        return $this;
    }

    public function getTipoPago(): ?TipoPago
    {
        return $this->tipoPago;
    }

    public function setTipoPago(?TipoPago $tipoPago): self
    {
        $this->tipoPago = $tipoPago;

        return $this;
    }
}
