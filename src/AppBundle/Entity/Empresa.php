<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Empresa
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\EmpresaRepository")
 */
class Empresa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=10)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="desccripcion", type="text")
     */
    private $desccripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=20)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_logo", type="string", length=255, nullable=true)
     */
    private $rutalogo;

    /**
     * @Assert\Image(maxSize = "1000k")
     */
    private $logo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="firma1", type="string", length=255)
     */
    private $firma1;

    /**
     * @var string
     *
     * @ORM\Column(name="firma2", type="string", length=255)
     */
    private $firma2;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="empresas")
     */
    protected $grupo;

    /**
     *
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="empresa", cascade={"remove"})
     *
     */
    private $usuarios;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Empresa
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Empresa
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set desccripcion
     *
     * @param string $desccripcion
     *
     * @return Empresa
     */
    public function setDesccripcion($desccripcion)
    {
        $this->desccripcion = $desccripcion;

        return $this;
    }

    /**
     * Get desccripcion
     *
     * @return string
     */
    public function getDesccripcion()
    {
        return $this->desccripcion;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Empresa
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Empresa
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    public function subirFoto()
    {
        if (null === $this->logo) {
            return;
        }
        $directorioDestino = __DIR__.'/../../../web/uploads/images/logo/';
        $nombreArchivoFoto = uniqid('logo-').'.jpg';
        $this->logo->move($directorioDestino, $nombreArchivoFoto);
        $this->setRutalogo($nombreArchivoFoto);
    }

    /**
     * @param UploadedFile $logo
     */
    public function setLogo(UploadedFile $logo = null)
    {
        $this->logo = $logo;
    }


    /**
     * @return UploadedFile
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Get __toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * Set rutalogo
     *
     * @param string $rutalogo
     *
     * @return Entidad
     */
    public function setRutalogo($rutalogo)
    {
        $this->rutalogo = $rutalogo;

        return $this;
    }

    /**
     * Get rutalogo
     *
     * @return string
     */
    public function getRutalogo()
    {
        return $this->rutalogo;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Empresa
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set firma1
     *
     * @param string $firma1
     *
     * @return Empresa
     */
    public function setFirma1($firma1)
    {
        $this->firma1 = $firma1;

        return $this;
    }

    /**
     * Get firma1
     *
     * @return string
     */
    public function getFirma1()
    {
        return $this->firma1;
    }

    /**
     * Set firma2
     *
     * @param string $firma2
     *
     * @return Empresa
     */
    public function setFirma2($firma2)
    {
        $this->firma2 = $firma2;

        return $this;
    }

    /**
     * Get firma2
     *
     * @return string
     */
    public function getFirma2()
    {
        return $this->firma2;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set grupo
     *
     * @param \AppBundle\Entity\Grupo $grupo
     *
     * @return Empresa
     */
    public function setGrupo(\AppBundle\Entity\Grupo $grupo = null)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return \AppBundle\Entity\Grupo
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Add usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Empresa
     */
    public function addUsuario(\AppBundle\Entity\Usuario $usuario)
    {
        $this->usuarios[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\AppBundle\Entity\Usuario $usuario)
    {
        $this->usuarios->removeElement($usuario);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }
}
