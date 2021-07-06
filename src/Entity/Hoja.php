<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table("hoja")
 * @ORM\Entity(repositoryClass="App\Repository\HojaRepository")
 * @UniqueEntity("tipoActo",message="Ya existe una Hoja con este Tipo de Acto.")
 */
class Hoja
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $cantidad
     * @ORM\Column(name="cantidad", type="integer", nullable=true, length=12)
    */
    protected $cantidad;

    /**
     * @var string $alarma
     * @ORM\Column(name="alarma", type="integer", nullable=true, length=12)
    */
    protected $alarma;

    /**
     * @ORM\OneToOne(targetEntity="TipoActo", mappedBy="hoja")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipoActo;

    /**
     * @ORM\OneToMany(targetEntity=ReposicionHoja::class, mappedBy="hoja")
     * @ORM\OrderBy({"fecha" = "DESC"})
     */
    private $reposiciones;

    public function __construct()
    {
        $this->reposiciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(?int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getAlarma(): ?int
    {
        return $this->alarma;
    }

    public function setAlarma(?int $alarma): self
    {
        $this->alarma = $alarma;

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
     * @return Collection|ReposicionHoja[]
     */
    public function getReposiciones(): Collection
    {
        return $this->reposiciones;
    }

    public function addReposicione(ReposicionHoja $reposicione): self
    {
        if (!$this->reposiciones->contains($reposicione)) {
            $this->reposiciones[] = $reposicione;
            $reposicione->setHoja($this);
        }

        return $this;
    }

    public function removeReposicione(ReposicionHoja $reposicione): self
    {
        if ($this->reposiciones->removeElement($reposicione)) {
            // set the owning side to null (unless already changed)
            if ($reposicione->getHoja() === $this) {
                $reposicione->setHoja(null);
            }
        }

        return $this;
    }
}
