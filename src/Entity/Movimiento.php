<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MovimientoRepository::class)
 */
class Movimiento
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
    * @ORM\Column(name="fechaInicio", type="date", nullable=false)
    */
    protected $fechaInicio;

    /**
    * @var string
    *
    * @ORM\Column(name="fechaFin", type="date", nullable=false)
    */
    protected $fechaFin;

     /**
    * @var string
    *
    * @ORM\Column(name="Lugar", type="date", nullable=false)
    */
    protected $lugar;

    /**
     * @ORM\ManyToOne(targetEntity=EstadoActo::class, inversedBy="movimientos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estado;

    /**
     * @ORM\ManyToOne(targetEntity=Acto::class, inversedBy="movimientos")
     * @ORM\JoinColumn(nullable=false)
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

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(\DateTimeInterface $fechaFin): self
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    public function getLugar(): ?\DateTimeInterface
    {
        return $this->lugar;
    }

    public function setLugar(\DateTimeInterface $lugar): self
    {
        $this->lugar = $lugar;

        return $this;
    }

    public function getEstado(): ?EstadoActo
    {
        return $this->estado;
    }

    public function setEstado(?EstadoActo $estado): self
    {
        $this->estado = $estado;

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
}
