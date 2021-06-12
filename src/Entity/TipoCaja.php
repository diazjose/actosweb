<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TipoCajaRepository::class)
 */
class TipoCaja
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
    * @ORM\Column(name="nombre", type="string", nullable=false)
    * @Assert\NotBlank(message="Por favor ingrese un Estado.") 
    */
    protected $nombre;

    /**
     * @ORM\OneToMany(targetEntity=Caja::class, mappedBy="concepto")
     */
    private $cajas;

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
        $this->cajas = new ArrayCollection();
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
        $this->nombre = $nombre;

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
     * @return Collection|Caja[]
     */
    public function getCajas(): Collection
    {
        return $this->cajas;
    }

    public function addCaja(Caja $caja): self
    {
        if (!$this->cajas->contains($caja)) {
            $this->cajas[] = $caja;
            $caja->setConcepto($this);
        }

        return $this;
    }

    public function removeCaja(Caja $caja): self
    {
        if ($this->cajas->removeElement($caja)) {
            // set the owning side to null (unless already changed)
            if ($caja->getConcepto() === $this) {
                $caja->setConcepto(null);
            }
        }

        return $this;
    }
}
