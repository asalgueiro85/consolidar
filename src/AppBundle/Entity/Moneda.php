<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moneda
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MonedaRepository")
 */
class Moneda
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
     * @ORM\Column(name="abrev", type="string", length=10)
     */
    private $abrev;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;


    /**
     *
     * @ORM\OneToMany(targetEntity="Modelo1006", mappedBy="moneda", cascade={"remove"})
     *
     */
    private $modelo1006;

    /**
     *
     * @ORM\OneToMany(targetEntity="Modelo1007", mappedBy="moneda", cascade={"remove"})
     *
     */
    private $modelo1007;


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
     * @return Moneda
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
     * Set abrev
     *
     * @param string $abrev
     *
     * @return Moneda
     */
    public function setAbrev($abrev)
    {
        $this->abrev = $abrev;

        return $this;
    }

    /**
     * Get abrev
     *
     * @return string
     */
    public function getAbrev()
    {
        return $this->abrev;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Moneda
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modelo1006 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->modelo1007 = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add modelo1006
     *
     * @param \AppBundle\Entity\Modelo1006 $modelo1006
     *
     * @return Moneda
     */
    public function addModelo1006(\AppBundle\Entity\Modelo1006 $modelo1006)
    {
        $this->modelo1006[] = $modelo1006;

        return $this;
    }

    /**
     * Remove modelo1006
     *
     * @param \AppBundle\Entity\Modelo1006 $modelo1006
     */
    public function removeModelo1006(\AppBundle\Entity\Modelo1006 $modelo1006)
    {
        $this->modelo1006->removeElement($modelo1006);
    }

    /**
     * Get modelo1006
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModelo1006()
    {
        return $this->modelo1006;
    }

    /**
     * Add modelo1007
     *
     * @param \AppBundle\Entity\Modelo1007 $modelo1007
     *
     * @return Moneda
     */
    public function addModelo1007(\AppBundle\Entity\Modelo1007 $modelo1007)
    {
        $this->modelo1007[] = $modelo1007;

        return $this;
    }

    /**
     * Remove modelo1007
     *
     * @param \AppBundle\Entity\Modelo1007 $modelo1007
     */
    public function removeModelo1007(\AppBundle\Entity\Modelo1007 $modelo1007)
    {
        $this->modelo1007->removeElement($modelo1007);
    }

    /**
     * Get modelo1007
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModelo1007()
    {
        return $this->modelo1007;
    }
    /**
     * Get __toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->abrev;
    }
}
