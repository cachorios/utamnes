<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Concepto
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", unique=true, nullable=false)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=64, nullable=false)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $descripcion_corta;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $obligatorio;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $activo;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_actualizacion;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="Ctacte", mappedBy="concepto")
     */
    private $ctacte;

    /**
     * @ORM\OneToMany(targetEntity="TrabajadorConcepto", mappedBy="concepto")
     */
    private $trabajadorConcepto;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ctacte = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set numero
     *
     * @param integer $numero
     * @return Concepto
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Concepto
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
     * Set descripcion_corta
     *
     * @param string $descripcionCorta
     * @return Concepto
     */
    public function setDescripcionCorta($descripcionCorta)
    {
        $this->descripcion_corta = $descripcionCorta;

        return $this;
    }

    /**
     * Get descripcion_corta
     *
     * @return string 
     */
    public function getDescripcionCorta()
    {
        return $this->descripcion_corta;
    }

    /**
     * Set obligatorio
     *
     * @param boolean $obligatorio
     * @return Concepto
     */
    public function setObligatorio($obligatorio)
    {
        $this->obligatorio = $obligatorio;

        return $this;
    }

    /**
     * Get obligatorio
     *
     * @return boolean 
     */
    public function getObligatorio()
    {
        return $this->obligatorio;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Concepto
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
     * Set fecha_actualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return Concepto
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
     * @return Concepto
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
     * Add ctacte
     *
     * @param \AppBundle\Entity\Ctacte $ctacte
     * @return Concepto
     */
    public function addCtacte(\AppBundle\Entity\Ctacte $ctacte)
    {
        $this->ctacte[] = $ctacte;

        return $this;
    }

    /**
     * Remove ctacte
     *
     * @param \AppBundle\Entity\Ctacte $ctacte
     */
    public function removeCtacte(\AppBundle\Entity\Ctacte $ctacte)
    {
        $this->ctacte->removeElement($ctacte);
    }

    /**
     * Get ctacte
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCtacte()
    {
        return $this->ctacte;
    }

    /**
     * Add trabajadorConcepto
     *
     * @param \AppBundle\Entity\TrabajadorConcepto $trabajadorConcepto
     * @return Concepto
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
}
