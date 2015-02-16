<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Trabajador
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    private $legajo;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_actualizacion;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="TrabajadorConcepto", mappedBy="trabajador")
     */
    private $trabajadorConcepto;

    /**
     * 
     * 
     */
    private $empleador;

    /**
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="trabajador")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id", nullable=false)
     */
    private $persona;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->trabajadorConcepto = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set legajo
     *
     * @param string $legajo
     * @return Trabajador
     */
    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;

        return $this;
    }

    /**
     * Get legajo
     *
     * @return string 
     */
    public function getLegajo()
    {
        return $this->legajo;
    }

    /**
     * Set fecha_actualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return Trabajador
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
     * @return Trabajador
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
     * Add trabajadorConcepto
     *
     * @param \AppBundle\Entity\TrabajadorConcepto $trabajadorConcepto
     * @return Trabajador
     */
    public function addTrabajadorConcepto(\AppBundle\Entity\TrabajadorConcepto $trabajadorConcepto)
    {
        $this->trabajadorConcepto[] = $trabajadorConcepto;

        return $this;
    }

    /**
     * Remove trabajadorConcepto
     *
     * @param \AppBundle\Entity\TrabajadorConcepto $trabajadorConcepto
     */
    public function removeTrabajadorConcepto(\AppBundle\Entity\TrabajadorConcepto $trabajadorConcepto)
    {
        $this->trabajadorConcepto->removeElement($trabajadorConcepto);
    }

    /**
     * Get trabajadorConcepto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrabajadorConcepto()
    {
        return $this->trabajadorConcepto;
    }

    /**
     * Set persona
     *
     * @param \AppBundle\Entity\Persona $persona
     * @return Trabajador
     */
    public function setPersona(\AppBundle\Entity\Persona $persona)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \AppBundle\Entity\Persona 
     */
    public function getPersona()
    {
        return $this->persona;
    }
}
