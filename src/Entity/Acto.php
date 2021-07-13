<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ActosRepository::class)
 */
class Acto
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
    * @ORM\Column(name="saldo", type="string", nullable=false) 
    */
    protected $saldo;

    /**
     * @ORM\OneToMany(targetEntity=Presupuesto::class, mappedBy="acto")
     */
    private $presupuestos;

    /**
     * @ORM\OneToMany(targetEntity=Caja::class, mappedBy="acto")
     */
    private $pagos;

    /**
    * @var string
    *
    * @ORM\Column(name="numeroHoja", type="string", nullable=false) 
    */
    protected $numeroHoja;

    /**
     * @ORM\ManyToOne(targetEntity=TipoActo::class, inversedBy="actos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipoActo;

     /**
     * @ORM\OneToMany(targetEntity=Movimiento::class, mappedBy="acto")
     */
    private $movimientos;

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
        $this->presupuestos = new ArrayCollection();
        $this->pagos = new ArrayCollection();
        $this->movimientos = new ArrayCollection();
    }


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

    public function getSaldo(): ?string
    {
        return $this->saldo;
    }

    public function setSaldo(string $saldo): self
    {
        $this->saldo = $saldo;

        return $this;
    }

    public function getNumeroHoja(): ?string
    {
        return $this->numeroHoja;
    }

    public function setNumeroHoja(string $numeroHoja): self
    {
        $this->numeroHoja = $numeroHoja;

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
     * @return Collection|Presupuesto[]
     */
    public function getPresupuestos(): Collection
    {
        return $this->presupuestos;
    }

    public function addPresupuesto(Presupuesto $presupuesto): self
    {
        if (!$this->presupuestos->contains($presupuesto)) {
            $this->presupuestos[] = $presupuesto;
            $presupuesto->setActo($this);
        }

        return $this;
    }

    public function removePresupuesto(Presupuesto $presupuesto): self
    {
        if ($this->presupuestos->removeElement($presupuesto)) {
            // set the owning side to null (unless already changed)
            if ($presupuesto->getActo() === $this) {
                $presupuesto->setActo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pago[]
     */
    public function getPagos(): Collection
    {
        return $this->pagos;
    }

    public function addPago(Pago $pago): self
    {
        if (!$this->pagos->contains($pago)) {
            $this->pagos[] = $pago;
            $pago->setActo($this);
        }

        return $this;
    }

    public function removePago(Pago $pago): self
    {
        if ($this->pagos->removeElement($pago)) {
            // set the owning side to null (unless already changed)
            if ($pago->getActo() === $this) {
                $pago->setActo(null);
            }
        }

        return $this;
    }

    public function getTipoActo(): ?TipoActo
    {
        return $this->tipoActo;
    }

    public function setTipoActo(?TipoActo $tipoActo): self
    {
        $this->tipoActo = $tipoActo;

        return $this;
    }

    /**
     * @return Collection|Movimiento[]
     */
    public function getMovimientos(): Collection
    {
        return $this->movimientos;
    }

    public function addMovimiento(Movimiento $movimiento): self
    {
        if (!$this->movimientos->contains($movimiento)) {
            $this->movimientos[] = $movimiento;
            $movimiento->setActo($this);
        }

        return $this;
    }

    public function removeMovimiento(Movimiento $movimiento): self
    {
        if ($this->movimientos->removeElement($movimiento)) {
            // set the owning side to null (unless already changed)
            if ($movimiento->getActo() === $this) {
                $movimiento->setActo(null);
            }
        }

        return $this;
    }
}
