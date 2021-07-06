<?php

namespace App\Entity;

use App\Repository\ReposicionHojaRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ReposicionHojaRepository::class)
 */
class ReposicionHoja
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
     * @Assert\Length(
     *      min = 0,
     *      max = 100,
     *      minMessage = "La Cantidad demasiado pequeña, no es valido.",
     *      maxMessage = "La Cantidad es demasiado grande, no es valido"
     * )
     * @Assert\NotBlank(message="Por favor ingrese Cantidad.")
    */
    protected $cantidad;

     /**
     * @var string $fecha
     * @ORM\Column(name="fecha", type="date", nullable=false)
     * @Assert\NotBlank(message="Por favor ingrese Fecha.")
     */
    
    protected $fecha;

    /**
     * @ORM\ManyToOne(targetEntity=Hoja::class, inversedBy="reposiciones")
     * @ORM\JoinColumn(nullable=false)
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

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

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

    public function getHoja(): ?Hoja
    {
        return $this->hoja;
    }

    public function setHoja(?Hoja $hoja): self
    {
        $this->hoja = $hoja;

        return $this;
    }
}
