<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vencimientos
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\VencimientosRepository")
 */
class Vencimiento
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
     * @var \AppBundle\Entity\Empresa
     *
     *  @ORM\ManyToOne(targetEntity="Empresa")
     */
    private $empresa;

    /**
     * @var integer
     *
     * @ORM\Column(name="anio", type="integer")
     */
    private $anio;

    /**
     * @var integer
     *
     * @ORM\Column(name="mes", type="integer")
     */
    private $mes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vencimiento", type="date")
     */
    private $vencimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="prorroga", type="date")
     */
    private $prorroga;


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
     * Set anio
     *
     * @param integer $anio
     * @return Vencimientos
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get anio
     *
     * @return integer 
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Set mes
     *
     * @param integer $mes
     * @return Vencimientos
     */
    public function setMes($mes)
    {
        $this->mes = $mes;

        return $this;
    }

    /**
     * Get mes
     *
     * @return integer 
     */
    public function getMes()
    {
        return $this->mes;
    }

    /**
     * Set vencimiento
     *
     * @param \DateTime $vencimiento
     * @return Vencimientos
     */
    public function setVencimiento($vencimiento)
    {
        $this->vencimiento = $vencimiento;

        return $this;
    }

    /**
     * Get vencimiento
     *
     * @return \DateTime 
     */
    public function getVencimiento()
    {
        return $this->vencimiento;
    }

    /**
     * Set prorroga
     *
     * @param \DateTime $prorroga
     * @return Vencimientos
     */
    public function setProrroga($prorroga)
    {
        $this->prorroga = $prorroga;

        return $this;
    }

    /**
     * Get prorroga
     *
     * @return \DateTime 
     */
    public function getProrroga()
    {
        return $this->prorroga;
    }

    /**
     * Set empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     * @return Vencimientos
     */
    public function setEmpresa(\AppBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \AppBundle\Entity\Empresa 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function __toString(){
        return sprintf("%d/%02d", $this->getAnio(), $this->getMes());
    }

}
