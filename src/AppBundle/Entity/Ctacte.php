<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ctacte
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CtacteRepository")
 */
class Ctacte
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
     * @var Empleador
     *  @ORM\ManyToOne(targetEntity="Empleador")
     */
    private $empleador;

    /**
     * @var Periodo
     *
     *  @ORM\ManyToOne(targetEntity="Periodo")
     */
    private $periodo;

    /**
     * @var Concepto*
     *  @ORM\ManyToOne(targetEntity="Concepto")
     */
    private $concepto;

    /**
     * @var Periodo
     *
     *  @ORM\ManyToOne(targetEntity="Periodo")
     */
    private $rectificado;

    /**
     * @var float
     *
     * @ORM\Column(name="importe", type="decimal")
     */
    private $importe;

    /**
     * @var float
     *
     * @ORM\Column(name="pago", type="decimal")
     */
    private $pago;

    /**
     * @var string
     *
     * @ORM\Column(name="comprobante", type="string", length=64, nullable=true)
     */
    private $comprobante;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPago", type="date", nullable=true)
     */
    private $fechaPago;




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
     * Set importe
     *
     * @param string $importe
     *
     * @return Ctacte
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * Get importe
     *
     * @return string
     */
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set pago
     *
     * @param string $pago
     *
     * @return Ctacte
     */
    public function setPago($pago)
    {
        $this->pago = $pago;

        return $this;
    }

    /**
     * Get pago
     *
     * @return string
     */
    public function getPago()
    {
        return $this->pago;
    }

    /**
     * Set comprobante
     *
     * @param string $comprobante
     *
     * @return Ctacte
     */
    public function setComprobante($comprobante)
    {
        $this->comprobante = $comprobante;

        return $this;
    }

    /**
     * Get comprobante
     *
     * @return string
     */
    public function getComprobante()
    {
        return $this->comprobante;
    }

    /**
     * Set fechaPago
     *
     * @param \DateTime $fechaPago
     *
     * @return Ctacte
     */
    public function setFechaPago($fechaPago)
    {
        $this->fechaPago = $fechaPago;

        return $this;
    }

    /**
     * Get fechaPago
     *
     * @return \DateTime
     */
    public function getFechaPago()
    {
        return $this->fechaPago;
    }

    /**
     * Set empleador
     *
     * @param \AppBundle\Entity\Empleador $empleador
     *
     * @return Ctacte
     */
    public function setEmpleador(\AppBundle\Entity\Empleador $empleador = null)
    {
        $this->empleador = $empleador;

        return $this;
    }

    /**
     * Get empleador
     *
     * @return \AppBundle\Entity\Empleador
     */
    public function getEmpleador()
    {
        return $this->empleador;
    }

    /**
     * Set periodo
     *
     * @param \AppBundle\Entity\Periodo $periodo
     *
     * @return Ctacte
     */
    public function setPeriodo(\AppBundle\Entity\Periodo $periodo = null)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get periodo
     *
     * @return \AppBundle\Entity\Periodo
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * Set concepto
     *
     * @param \AppBundle\Entity\Concepto $concepto
     *
     * @return Ctacte
     */
    public function setConcepto(\AppBundle\Entity\Concepto $concepto = null)
    {
        $this->concepto = $concepto;

        return $this;
    }

    /**
     * Get concepto
     *
     * @return \AppBundle\Entity\Concepto
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * Set rectificado
     *
     * @param \AppBundle\Entity\Periodo $rectificado
     *
     * @return Ctacte
     */
    public function setRectificado(\AppBundle\Entity\Periodo $rectificado = null)
    {
        $this->rectificado = $rectificado;

        return $this;
    }

    /**
     * Get rectificado
     *
     * @return \AppBundle\Entity\Periodo
     */
    public function getRectificado()
    {
        return $this->rectificado;
    }
}
