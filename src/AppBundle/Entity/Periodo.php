<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Periodo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PeriodoRepository")
 */
class Periodo
{
    static public $_TIPO = array(
        "Original",
        "1er.Rect.",
        "2da.Rect.",
        "3er.Rect.",
        "4ta.Rect.",
        "5ta.Rect.",
        "6ta.Rect.",
        "7ma.Rect.",
        "8va.Rect.",
        "9na.Rect.",
    );

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     *  @ORM\ManyToOne(targetEntity="Vencimiento")
     */
    private $vencimiento;

    /**
     *
     *  @ORM\ManyToOne(targetEntity="Empleador")
     */
    private $empleador;

    /**
     * @var integer
     *
     * @ORM\Column(name="liquidacion", type="integer")
     */
    private $liquidacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $activo;




    public function __construct(){
        $this->setTipo(0);
        $this->activo = 0;
    }



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
     * Set liquidacion
     *
     * @param integer $liquidacion
     * @return Periodo
     */
    public function setLiquidacion($liquidacion)
    {
        $this->liquidacion = $liquidacion;

        return $this;
    }

    /**
     * Get liquidacion
     *
     * @return integer 
     */
    public function getLiquidacion()
    {
        return $this->liquidacion;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Periodo
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
     * Set vencimiento
     *
     * @param \AppBundle\Entity\Vencimiento $vencimiento
     * @return Periodo
     */
    public function setVencimiento(\AppBundle\Entity\Vencimiento $vencimiento = null)
    {
        $this->vencimiento = $vencimiento;

        return $this;
    }

    /**
     * Get vencimiento
     *
     * @return \AppBundle\Entity\Vencimiento 
     */
    public function getVencimiento()
    {
        return $this->vencimiento;
    }

    public function __toString(){
        return sprintf("%s - %d(%d)",$this->getVencimiento(),$this->getLiquidacion(), $this->getTipo(), $this->getEmpleador());

    }

    public function getTipoStr(){
        return self::$_TIPO[$this->getTipo()];
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Periodo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set empleador
     *
     * @param \AppBundle\Entity\Empleador $empleador
     * @return Periodo
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
}
