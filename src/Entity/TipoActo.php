<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table("tipo_acto")
 * @ORM\Entity(repositoryClass="App\Repository\TipoActoRepository")
 * @UniqueEntity("nombre",message="Este Concepto ya existe.")
 */
class TipoActo
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
    * @ORM\Column(name="nombre", type="string", nullable=false, unique=true)
    * @Assert\NotBlank(message="Por favor ingrese un Nombre de Acto.") 
    */
    protected $nombre;

    /**
     * @ORM\OneToMany(targetEntity=Acto::class, mappedBy="tipoActo")
     */
    private $actos;

    /**
     * @ORM\OneToMany(targetEntity=Presupuesto::class, mappedBy="acto")
     */
    private $presupuestos;

    /** 
     * @ORM\OneToOne(targetEntity="Hoja", inversedBy="tipoActo")
     * @ORM\JoinColumn(name="hoja_id", referencedColumnName="id", nullable=true)
     */
    private $hoja;

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
        $this->actos = new ArrayCollection();
        $this->presupuestos = new ArrayCollection();
    }

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
        $this->nombre = strtoupper($nombre);

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
     * @return Collection|Acto[]
     */
    public function getActos(): Collection
    {
        return $this->actos;
    }

    public function addActo(Acto $acto): self
    {
        if (!$this->actos->contains($acto)) {
            $this->actos[] = $acto;
            $acto->setTipoActo($this);
        }

        return $this;
    }

    public function removeActo(Acto $acto): self
    {
        if ($this->actos->removeElement($acto)) {
            // set the owning side to null (unless already changed)
            if ($acto->getTipoActo() === $this) {
                $acto->setTipoActo(null);
            }
        }

        return $this;
    }

    public function getHoja(): ?Hoja
    {
        return $this->hoja;
    }

    public function setHoja(?Hoja $hoja): self
    {
        $this->hoja = $hoja;

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
}
