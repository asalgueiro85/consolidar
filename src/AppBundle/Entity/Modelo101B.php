<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modelo101B
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Modelo101BRepository")
 */
class Modelo101B
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
     * @var integer
     *
     * @ORM\Column(name="ext_no_ven", type="integer")
     */
    private $extNoVen;

    /**
     * @var integer
     *
     * @ORM\Column(name="ext_0_60", type="integer")
     */
    private $ext060;

    /**
     * @var integer
     *
     * @ORM\Column(name="ext_61_90", type="integer")
     */
    private $ext6190;

    /**
     * @var integer
     *
     * @ORM\Column(name="ext_mas90", type="integer")
     */
    private $extMas90;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", options ={"default":1})
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="ext_tot_ve", type="integer")
     */
    private $extTotVe;

    /**
     * @var integer
     *
     * @ORM\Column(name="ext_efecto", type="integer")
     */
    private $extEfecto;

    /**
     * @var integer
     *
     * @ORM\Column(name="lit_jud_e", type="integer")
     */
    private $litJudE;

    /**
     * @var integer
     *
     * @ORM\Column(name="lit_prot_e", type="integer")
     */
    private $litProtE;

    /**
     * @var integer
     *
     * @ORM\Column(name="sent_pent_e", type="integer")
     */
    private $sentPentE;

    /**
     * @var integer
     *
     * @ORM\Column(name="t_vt_cr_ex", type="integer")
     */
    private $tVtCrEx;

    /**
     * @var integer
     *
     * @ORM\Column(name="contravalor", type="integer")
     */
    private $contravalor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="modelos101B")
     */
    protected $usuario;

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
     * Set extNoVen
     *
     * @param integer $extNoVen
     *
     * @return Modelo101B
     */
    public function setExtNoVen($extNoVen)
    {
        $this->extNoVen = $extNoVen;

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

    /**
     * Set Estado
     *
     * @param integer $estado
     *
     * @return Modelo101B
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get extNoVen
     *
     * @return integer
     */
    public function getExtNoVen()
    {
        return $this->extNoVen;
    }

    /**
     * Set ext060
     *
     * @param integer $ext060
     *
     * @return Modelo101B
     */
    public function setExt060($ext060)
    {
        $this->ext060 = $ext060;

        return $this;
    }

    /**
     * Get ext060
     *
     * @return integer
     */
    public function getExt060()
    {
        return $this->ext060;
    }

    /**
     * Set ext6190
     *
     * @param integer $ext6190
     *
     * @return Modelo101B
     */
    public function setExt6190($ext6190)
    {
        $this->ext6190 = $ext6190;

        return $this;
    }

    /**
     * Get ext6190
     *
     * @return integer
     */
    public function getExt6190()
    {
        return $this->ext6190;
    }

    /**
     * Set extMas90
     *
     * @param integer $extMas90
     *
     * @return Modelo101B
     */
    public function setExtMas90($extMas90)
    {
        $this->extMas90 = $extMas90;

        return $this;
    }

    /**
     * Get extMas90
     *
     * @return integer
     */
    public function getExtMas90()
    {
        return $this->extMas90;
    }

    /**
     * Set extTotVe
     *
     * @param integer $extTotVe
     *
     * @return Modelo101B
     */
    public function setExtTotVe($extTotVe)
    {
        $this->extTotVe = $extTotVe;

        return $this;
    }

    /**
     * Get extTotVe
     *
     * @return integer
     */
    public function getExtTotVe()
    {
        return $this->extTotVe;
    }

    /**
     * Set extEfecto
     *
     * @param integer $extEfecto
     *
     * @return Modelo101B
     */
    public function setExtEfecto($extEfecto)
    {
        $this->extEfecto = $extEfecto;

        return $this;
    }

    /**
     * Get extEfecto
     *
     * @return integer
     */
    public function getExtEfecto()
    {
        return $this->extEfecto;
    }

    /**
     * Set litJudE
     *
     * @param integer $litJudE
     *
     * @return Modelo101B
     */
    public function setLitJudE($litJudE)
    {
        $this->litJudE = $litJudE;

        return $this;
    }

    /**
     * Get litJudE
     *
     * @return integer
     */
    public function getLitJudE()
    {
        return $this->litJudE;
    }

    /**
     * Set litProtE
     *
     * @param integer $litProtE
     *
     * @return Modelo101B
     */
    public function setLitProtE($litProtE)
    {
        $this->litProtE = $litProtE;

        return $this;
    }

    /**
     * Get litProtE
     *
     * @return integer
     */
    public function getLitProtE()
    {
        return $this->litProtE;
    }

    /**
     * Set sentPentE
     *
     * @param integer $sentPentE
     *
     * @return Modelo101B
     */
    public function setSentPentE($sentPentE)
    {
        $this->sentPentE = $sentPentE;

        return $this;
    }

    /**
     * Get sentPentE
     *
     * @return integer
     */
    public function getSentPentE()
    {
        return $this->sentPentE;
    }

    /**
     * Set tVtCrEx
     *
     * @param integer $tVtCrEx
     *
     * @return Modelo101B
     */
    public function setTVtCrEx($tVtCrEx)
    {
        $this->tVtCrEx = $tVtCrEx;

        return $this;
    }

    /**
     * Get tVtCrEx
     *
     * @return integer
     */
    public function getTVtCrEx()
    {
        return $this->tVtCrEx;
    }

    /**
     * Set contravalor
     *
     * @param integer $contravalor
     *
     * @return Modelo101B
     */
    public function setContravalor($contravalor)
    {
        $this->contravalor = $contravalor;

        return $this;
    }

    /**
     * Get contravalor
     *
     * @return integer
     */
    public function getContravalor()
    {
        return $this->contravalor;
    }



    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Modelo101B
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Modelo101B
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
}
