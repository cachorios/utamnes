<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatoLiquidacion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DatoLiquidacion
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
     * @var Periodo
     *  @ORM\ManyToOne(targetEntity="Periodo")
     */
    private $periodo;

    /**
     * @var Trabajador
     *
     *  @ORM\ManyToOne(targetEntity="Trabajador")
     */

    private $trabajador;

    /**
     * @var string
     *
     * @ORM\Column(name="tr", type="decimal")
     */
    private $tr;

    /**
     * @var string
     *
     * @ORM\Column(name="imp1", type="decimal")
     */
    private $imp1;

    /**
     * @var string
     *
     * @ORM\Column(name="imp2", type="decimal")
     */
    private $imp2;

    /**
     * @var string
     *
     * @ORM\Column(name="imp3", type="decimal")
     */
    private $imp3;

    /**
     * @var string
     *
     * @ORM\Column(name="imp4", type="decimal")
     */
    private $imp4;

    /**
     * @var string
     *
     * @ORM\Column(name="imp5", type="decimal")
     */
    private $imp5;

    /**
     * @var string
     *
     * @ORM\Column(name="imp6", type="decimal")
     */
    private $imp6;

    /**
     * @var string
     *
     * @ORM\Column(name="imp7", type="decimal")
     */
    private $imp7;

    /**
     * @var string
     *
     * @ORM\Column(name="imp8", type="decimal")
     */
    private $imp8;

    /**
     * @var string
     *
     * @ORM\Column(name="imp9", type="decimal")
     */
    private $imp9;


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
     * Set tr
     *
     * @param string $tr
     *
     * @return DatoLiquidacion
     */
    public function setTr($tr)
    {
        $this->tr = $tr;

        return $this;
    }

    /**
     * Get tr
     *
     * @return string
     */
    public function getTr()
    {
        return $this->tr;
    }

    /**
     * Set imp1
     *
     * @param string $imp1
     *
     * @return DatoLiquidacion
     */
    public function setImp1($imp1)
    {
        $this->imp1 = $imp1;
        return $this;
    }

    /**
     * Get imp1
     *
     * @return string
     */
    public function getImp1()
    {
        return $this->imp1;
    }

    /**
     * Set imp2
     *
     * @param string $imp2
     *
     * @return DatoLiquidacion
     */
    public function setImp2($imp2)
    {
        $this->imp2 = $imp2;
        return $this;
    }

    /**
     * Get imp2
     *
     * @return string
     */
    public function getImp2()
    {
        return $this->imp2;
    }

    /**
     * Set imp3
     *
     * @param string $imp3
     *
     * @return DatoLiquidacion
     */
    public function setImp3($imp3)
    {
        $this->imp3 = $imp3;

        return $this;
    }

    /**
     * Get imp3
     *
     * @return string
     */
    public function getImp3()
    {
        return $this->imp3;
    }

    /**
     * Set imp4
     *
     * @param string $imp4
     *
     * @return DatoLiquidacion
     */
    public function setImp4($imp4)
    {
        $this->imp4 = $imp4;

        return $this;
    }

    /**
     * Get imp4
     *
     * @return string
     */
    public function getImp4()
    {
        return $this->imp4;
    }

    /**
     * Set imp5
     *
     * @param string $imp5
     *
     * @return DatoLiquidacion
     */
    public function setImp5($imp5)
    {
        $this->imp5 = $imp5;

        return $this;
    }

    /**
     * Get imp5
     *
     * @return string
     */
    public function getImp5()
    {
        return $this->imp5;
    }

    /**
     * Set imp6
     *
     * @param string $imp6
     *
     * @return DatoLiquidacion
     */
    public function setImp6($imp6)
    {
        $this->imp6 = $imp6;

        return $this;
    }

    /**
     * Get imp6
     *
     * @return string
     */
    public function getImp6()
    {
        return $this->imp6;
    }

    /**
     * Set imp7
     *
     * @param string $imp7
     *
     * @return DatoLiquidacion
     */
    public function setImp7($imp7)
    {
        $this->imp7 = $imp7;

        return $this;
    }

    /**
     * Get imp7
     *
     * @return string
     */
    public function getImp7()
    {
        return $this->imp7;
    }

    /**
     * Set imp8
     *
     * @param string $imp8
     *
     * @return DatoLiquidacion
     */
    public function setImp8($imp8)
    {
        $this->imp8 = $imp8;

        return $this;
    }

    /**
     * Get imp8
     *
     * @return string
     */
    public function getImp8()
    {
        return $this->imp8;
    }

    /**
     * Set imp9
     *
     * @param string $imp9
     *
     * @return DatoLiquidacion
     */
    public function setImp9($imp9)
    {
        $this->imp9 = $imp9;

        return $this;
    }

    /**
     * Get imp9
     *
     * @return string
     */
    public function getImp9()
    {
        return $this->imp9;
    }

    /**
     * Set periodo
     *
     * @param \AppBundle\Entity\Periodo $periodo
     *
     * @return DatoLiquidacion
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
     * Set trabajador
     *
     * @param \AppBundle\Entity\Trabajador $trabajador
     *
     * @return DatoLiquidacion
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
}
