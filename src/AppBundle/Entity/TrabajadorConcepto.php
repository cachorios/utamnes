<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class TrabajadorConcepto
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_actualizacion;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Trabajador", inversedBy="trabajadorConcepto")
     * @ORM\JoinColumn(name="trabajador_id", referencedColumnName="id", nullable=false)
     */
    private $trabajador;

    /**
     * @ORM\ManyToOne(targetEntity="Concepto", inversedBy="trabajadorConcepto")
     * @ORM\JoinColumn(name="concepto_id", referencedColumnName="id", nullable=false)
     */
    private $concepto;

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
     * Set fecha_actualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return TrabajadorConcepto
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fecha_actualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Get fecha_actualizacion
     *
     * @return \DateTime 
     */
    public function getFechaActualizacion()
    {
        return $this->fecha_actualizacion;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     * @return TrabajadorConcepto
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set trabajador
     *
     * @param \AppBundle\Entity\Trabajador $trabajador
     * @return TrabajadorConcepto
     */
    public function setTrabajador(\AppBundle\Entity\Trabajador $trabajador)
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
     * Set concepto
     *
     * @param \AppBundle\Entity\Concepto $concepto
     * @return TrabajadorConcepto
     */
    public function setConcepto(\AppBundle\Entity\Concepto $concepto)
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
