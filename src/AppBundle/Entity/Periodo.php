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
    static public $_TIPO = array("Original", "1er.Rect.", "2da.Rect.", "3er.Rect.", "4ta.Rect.");
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
        return sprintf("%s - %d(%d)",$this->getVencimiento(),$this->getLiquidacion(), $this->getTipo());

    }

    public function getTipoStr(){
        return self::$_TIPO[$this->getTipo()];
    }
}
