<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Grupo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\GrupoRepository")
 */
class Grupo
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
     * @ORM\Column(name="ruta_logo", type="string", length=255, nullable=true)
     */
    private $rutalogo;

    /**
     * @Assert\Image(maxSize = "1000k")
     */
    private $logo;

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
     * @ORM\OneToMany(targetEntity="Empresa", mappedBy="grupo", cascade={"remove"})
     *
     */
    private $empresas;


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
     * @return Grupo
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
     * @return Grupo
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
     * Set firma1
     *
     * @param string $firma1
     *
     * @return Grupo
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
     * @return Grupo
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
        $this->empresas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     *
     * @return Grupo
     */
    public function addEmpresa(\AppBundle\Entity\Empresa $empresa)
    {
        $this->empresas[] = $empresa;

        return $this;
    }

    /**
     * Remove empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     */
    public function removeEmpresa(\AppBundle\Entity\Empresa $empresa)
    {
        $this->empresas->removeElement($empresa);
    }

    /**
     * Get empresas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmpresas()
    {
        return $this->empresas;
    }
}
