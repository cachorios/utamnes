<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Liquidacion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Liquidacion
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
     * @var Trabajador
     *  @ORM\ManyToOne(targetEntity="Trabajador")
     */
    private $trabajador;

    /**
     * @var Periodo
     *  @ORM\ManyToOne(targetEntity="Periodo")
     */
    private $periodo;

    /**
     *  @ORM\ManyToOne(targetEntity="Concepto")
     */
    private $concepto;

    /**
     * @var string
     *
     * @ORM\Column(name="importe", type="decimal")
     */
    private $importe;


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
     * @return Liquidacion
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
     * Set trabajador
     *
     * @param \AppBundle\Entity\Trabajador $trabajador
     *
     * @return Liquidacion
     */
    public function setTrabajador(\AppBundle\Entity\Trabajador $trabajador = null)
    {
        $this->trabajador = $trabajador;

        return $this;
    }

    /**
     * Get trabajador
     *
     * @return \AppBundle\Entity\Trabajador
     */
    public function getTrabajador()
    {
        return $this->trabajador;
    }

    /**
     * Set periodo
     *
     * @param \AppBundle\Entity\Periodo $periodo
     *
     * @return Liquidacion
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
     * @return Liquidacion
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
}
