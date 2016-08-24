<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modelo1006
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Modelo1006Repository")
 */
class Modelo1006
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
     * @ORM\Column(name="contrato", type="string", length=20)
     */
    private $contrato;

    /**
     * @var string
     *
     * @ORM\Column(name="prestamista", type="string", length=20)
     */
    private $prestamista;



    /**
     * @var string
     *
     * @ORM\Column(name="termino", type="float")
     */
    private $termino;



    /**
     * @var string
     *
     * @ORM\Column(name="imp_principal", type="float")
     */
    private $impPrincipal;

    /**
     * @var integer
     *
     * @ORM\Column(name="a_pago", type="integer")
     */
    private $aPago;

    /**
     * @var string
     *
     * @ORM\Column(name="princi_vdo", type="float")
     */
    private $princiVdo;

    /**
     * @var string
     *
     * @ORM\Column(name="imp_intcov", type="float")
     */
    private $impIntcov;

    /**
     * @var string
     *
     * @ORM\Column(name="imp_intmor", type="float")
     */
    private $impIntmor;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Modelo", inversedBy="modelos1006", cascade={"persist"})
     */
    protected $modelo;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Moneda", inversedBy="modelo1006")
     */
    protected $moneda;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Pais", inversedBy="modelo1006")
     */
    protected $pais;

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
     * Set contrato
     *
     * @param string $contrato
     *
     * @return Modelo1006
     */
    public function setContrato($contrato)
    {
        $this->contrato = $contrato;

        return $this;
    }

    /**
     * Get contrato
     *
     * @return string
     */
    public function getContrato()
    {
        return $this->contrato;
    }

    /**
     * Set prestamista
     *
     * @param string $prestamista
     *
     * @return Modelo1006
     */
    public function setPrestamista($prestamista)
    {
        $this->prestamista = $prestamista;

        return $this;
    }

    /**
     * Get prestamista
     *
     * @return string
     */
    public function getPrestamista()
    {
        return $this->prestamista;
    }



    /**
     * Set termino
     *
     * @param string $termino
     *
     * @return Modelo1006
     */
    public function setTermino($termino)
    {
        $this->termino = $termino;

        return $this;
    }

    /**
     * Get termino
     *
     * @return string
     */
    public function getTermino()
    {
        return $this->termino;
    }



    /**
     * Set impPrincipal
     *
     * @param string $impPrincipal
     *
     * @return Modelo1006
     */
    public function setImpPrincipal($impPrincipal)
    {
        $this->impPrincipal = $impPrincipal;

        return $this;
    }

    /**
     * Get impPrincipal
     *
     * @return string
     */
    public function getImpPrincipal()
    {
        return $this->impPrincipal;
    }

    /**
     * Set aPago
     *
     * @param integer $aPago
     *
     * @return Modelo1006
     */
    public function setAPago($aPago)
    {
        $this->aPago = $aPago;

        return $this;
    }

    /**
     * Get aPago
     *
     * @return integer
     */
    public function getAPago()
    {
        return $this->aPago;
    }

    /**
     * Set princiVdo
     *
     * @param string $princiVdo
     *
     * @return Modelo1006
     */
    public function setPrinciVdo($princiVdo)
    {
        $this->princiVdo = $princiVdo;

        return $this;
    }

    /**
     * Get princiVdo
     *
     * @return string
     */
    public function getPrinciVdo()
    {
        return $this->princiVdo;
    }

    /**
     * Set impIntcov
     *
     * @param string $impIntcov
     *
     * @return Modelo1006
     */
    public function setImpIntcov($impIntcov)
    {
        $this->impIntcov = $impIntcov;

        return $this;
    }

    /**
     * Get impIntcov
     *
     * @return string
     */
    public function getImpIntcov()
    {
        return $this->impIntcov;
    }

    /**
     * Set impIntmor
     *
     * @param string $impIntmor
     *
     * @return Modelo1006
     */
    public function setImpIntmor($impIntmor)
    {
        $this->impIntmor = $impIntmor;

        return $this;
    }

    /**
     * Get impIntmor
     *
     * @return string
     */
    public function getImpIntmor()
    {
        return $this->impIntmor;
    }

    /**
     * Set modelo
     *
     * @param \AppBundle\Entity\Modelo $modelo
     *
     * @return Modelo1006
     */
    public function setModelo(\AppBundle\Entity\Modelo $modelo = null)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return \AppBundle\Entity\Modelo
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set moneda
     *
     * @param \AppBundle\Entity\Moneda $moneda
     *
     * @return Modelo1006
     */
    public function setMoneda(\AppBundle\Entity\Moneda $moneda = null)
    {
        $this->moneda = $moneda;

        return $this;
    }

    /**
     * Get moneda
     *
     * @return \AppBundle\Entity\Moneda
     */
    public function getMoneda()
    {
        return $this->moneda;
    }

    /**
     * Set pais
     *
     * @param \AppBundle\Entity\Pais $pais
     *
     * @return Modelo1006
     */
    public function setPais(\AppBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \AppBundle\Entity\Pais
     */
    public function getPais()
    {
        return $this->pais;
    }
}
