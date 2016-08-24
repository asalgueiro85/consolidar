<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modelo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ModeloRepository")
 */
class Modelo
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer")
     */
    private $estado;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="modelos")
     */
    protected $usuario;

    /**
     *
     * @ORM\OneToMany(targetEntity="Modelo1006", mappedBy="modelo", cascade={"remove"})
     *
     */
    private $modelos1006;

    /**
     *
     * @ORM\OneToMany(targetEntity="Modelo1007", mappedBy="modelo", cascade={"remove"})
     *
     */
    private $modelos1007;



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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Modelo
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return Modelo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modelos1006 = new \Doctrine\Common\Collections\ArrayCollection();
        $this->modelos1007 = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Modelo
     */
    public function setUsuario(\AppBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add modelos1006
     *
     * @param \AppBundle\Entity\Modelo1006 $modelos1006
     *
     * @return Modelo
     */
    public function addModelos1006(\AppBundle\Entity\Modelo1006 $modelos1006)
    {
        $this->modelos1006[] = $modelos1006;

        return $this;
    }

    /**
     * Remove modelos1006
     *
     * @param \AppBundle\Entity\Modelo1006 $modelos1006
     */
    public function removeModelos1006(\AppBundle\Entity\Modelo1006 $modelos1006)
    {
        $this->modelos1006->removeElement($modelos1006);
    }

    /**
     * Get modelos1006
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModelos1006()
    {
        return $this->modelos1006;
    }

    /**
     * Add modelos1007
     *
     * @param \AppBundle\Entity\Modelo1007 $modelos1007
     *
     * @return Modelo
     */
    public function addModelos1007(\AppBundle\Entity\Modelo1007 $modelos1007)
    {
        $this->modelos1007[] = $modelos1007;

        return $this;
    }

    /**
     * Remove modelos1007
     *
     * @param \AppBundle\Entity\Modelo1007 $modelos1007
     */
    public function removeModelos1007(\AppBundle\Entity\Modelo1007 $modelos1007)
    {
        $this->modelos1007->removeElement($modelos1007);
    }

    /**
     * Get modelos1007
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModelos1007()
    {
        return $this->modelos1007;
    }



    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Modelo
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }
    public  function __toString(){
        return 'modelo';
    }
}
