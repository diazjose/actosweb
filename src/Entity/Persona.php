<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table("Persona")
 * @ORM\Entity(repositoryClass="App\Repository\PersonaRepository")
 * @Gedmo\Loggable
 * @UniqueEntity("dni",message="Este DNI ya existe.")
 */
class Persona
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @var string $nombre
     * @ORM\Column(name="nombre", type="string", nullable=true, length=255)
     * @Gedmo\Versioned
     * @Assert\NotBlank(message="Por favor ingrese su nombre.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "El nombre es demasiado corto.",
     *      maxMessage = "El nombre es demasiado largo.",
     *      groups={"Registration", "Profile"}
     * )
     *
     */
    protected $nombre;

    /**
     * @var string $apellidos
     * @ORM\Column(name="apellidos", type="string", nullable=true, length=255)
     * @Gedmo\Versioned
     * @Assert\NotBlank(message="Por favor ingrese su apellido.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "El apellido es demasiado corto.",
     *      maxMessage = "El apellido es demasiado largo.",
     *      groups={"Registration", "Profile"}
     * )
     *
     */
    protected $apellidos;

    /**
     * @var string $dni
     * @ORM\Column(name="dni", type="integer", nullable=true, length=12, unique=true)
     * @Gedmo\Versioned
     * @Assert\NotBlank(message="Por favor ingrese su apellido.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *      min = 10000000,
     *      max = 50000000,
     *      minMessage = "El dni es demasiado pequeño, no es valido.",
     *      maxMessage = "El dni es demasiado grande, no es valido",
     *      groups={"Registration", "Profile"}
     * )
     *
     */
    protected $dni;

    /**
    * @var string
    *
    * @ORM\Column(name="cuil", type="string", nullable=true)
    */
    protected $cuil;

    /**
     * @var string $fechaNac
     * @ORM\Column(name="fechaNac", type="date", nullable=true)
     */
    
    protected $fechaNac;

    /**
    * @var string
    *
    * @ORM\Column(name="email", type="string", nullable=true)
    * @Assert\Email()
    */
    protected $email;

    /**
    * @var string
    *
    * @ORM\Column(name="domicilio", type="string", nullable=true)
    */
    protected $domicilio;

    /**
    * @var string
    *
    * @ORM\Column(name="estadoCivil", type="string", nullable=true) 
    */
    protected $estadoCivil;

     /**
     * @var string $telephone
     * @Gedmo\Versioned
     * @ORM\Column(name="telephone", type="string", nullable=true, length=255)
     */
    protected $telephone;

    /**
    * @var string
    *
    * @ORM\Column(name="nacionalidad", type="string", nullable=true)
    */
    protected $nacionalidad;

    /**
     * @ORM\OneToMany(targetEntity=DocPersonal::class, mappedBy="persona")
     */
    private $archivos;
    
    /**
     * @ORM\ManyToOne(targetEntity=Parentesco::class, inversedBy="persona")
     * @ORM\JoinColumn(nullable=true)
     */
    private $parentesco;

    /** 
     * @ORM\OneToOne(targetEntity="Persona", inversedBy="parent")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TipoRol", mappedBy="persona", cascade={"persist"})
     */
    private $roles;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

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
        $this->archivos = new ArrayCollection();
        $this->roles = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = strtoupper($nombre);

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(?string $apellidos): self
    {
        $this->apellidos = strtoupper($apellidos);

        return $this;
    }

    public function getDni(): ?int
    {
        return $this->dni;
    }

    public function setDni(?int $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

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

    public function getCuil(): ?string
    {
        return $this->cuil;
    }

    public function setCuil(string $cuil): self
    {
        $this->cuil = $cuil;

        return $this;
    }

    public function getDomicilio(): ?string
    {
        return $this->domicilio;
    }

    public function setDomicilio(?string $domicilio): self
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    public function getEstadoCivil(): ?string
    {
        return $this->estadoCivil;
    }

    public function setEstadoCivil(?string $estadoCivil): self
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    public function getFechaNac(): ?\DateTimeInterface
    {
        return $this->fechaNac;
    }

    public function setFechaNac(?\DateTimeInterface $fechaNac): self
    {
        $this->fechaNac = $fechaNac;

        return $this;
    }

    public function getNacionalidad(): ?string
    {
        return $this->nacionalidad;
    }

    public function setNacionalidad(?string $nacionalidad): self
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * @return Collection|DocPersonal[]
     */
    public function getArchivos(): Collection
    {
        return $this->archivos;
    }

    public function addArchivo(DocPersonal $archivo): self
    {
        if (!$this->archivos->contains($archivo)) {
            $this->archivos[] = $archivo;
            $archivo->setPersona($this);
        }

        return $this;
    }

    public function removeArchivo(DocPersonal $archivo): self
    {
        if ($this->archivos->removeElement($archivo)) {
            // set the owning side to null (unless already changed)
            if ($archivo->getPersona() === $this) {
                $archivo->setPersona(null);
            }
        }

        return $this;
    }

    public function getParentesco(): ?Parentesco
    {
        return $this->parentesco;
    }

    public function setParentesco(?Parentesco $parentesco): self
    {
        $this->parentesco = $parentesco;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|TipoRol[]
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(TipoRol $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
            $role->setPersona($this);
        }

        return $this;
    }

    public function removeRole(TipoRol $role): self
    {
        if ($this->roles->removeElement($role)) {
            // set the owning side to null (unless already changed)
            if ($role->getPersona() === $this) {
                $role->setPersona(null);
            }
        }

        return $this;
    }
}
