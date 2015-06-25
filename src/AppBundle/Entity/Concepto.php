<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Entity
 * @ORM\Table("concepto")
 */
class Concepto
{
    use ORMBehaviors\Timestampable\Timestampable;
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
     * @ORM\ManyToOne(targetEntity="RBSoft\UsuarioBundle\Entity\Usuario")
     */
    private $usuario;




    /**
     * @var formula
     * @ORM\Column(type="string", length=256, nullable=false)
     */
    private $formula;

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
     * Constructor
     */
    public function __construct()
    {
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
     * Add trabajador
     *
     * @param \AppBundle\Entity\Trabajador $trabajador
     * @return Concepto
     */
    public function addTrabajador(\AppBundle\Entity\Trabajador $trabajador)
    {
        $this->trabajador[] = $trabajador;

        return $this;
    }

    /**
     * Remove trabajador
     *
     * @param \AppBundle\Entity\Trabajador $trabajador
     */
    public function removeTrabajador(\AppBundle\Entity\Trabajador $trabajador)
    {
        $this->trabajador->removeElement($trabajador);
    }

    /**
     * Get trabajador
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrabajador()
    {
        return $this->trabajador;
    }

    public function __toString()
    {
        return $this->getDescripcion();
    }

    /**
     * Set formula
     *
     * @param string $formula
     *
     * @return Concepto
     */
    public function setFormula($formula)
    {
        $this->formula = $formula;

        return $this;
    }

    /**
     * Get formula
     *
     * @return string
     */
    public function getFormula()
    {
        return $this->formula;
    }
}
