<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Periodo
 *
 * @ORM\Table("periodo")
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
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $descripcion;

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

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecha_presentacion;




    public function __construct(){
        $this->setTipo(0);
        $this->setActivo(0);
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
        return sprintf("%s - %d(%s)",$this->getVencimiento(),$this->getLiquidacion(), self::$_TIPO[$this->getTipo()] );

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

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Periodo
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
     * Set fecha_presentacion
     *
     * @param \DateTime $fechaPresentacion
     * @return Periodo
     */
    public function setFechaPresentacion($fechaPresentacion)
    {
        $this->fecha_presentacion = $fechaPresentacion;

        return $this;
    }

    /**
     * Get fecha_presentacion
     *
     * @return \DateTime 
     */
    public function getFechaPresentacion()
    {
        return $this->fecha_presentacion;
    }
}
