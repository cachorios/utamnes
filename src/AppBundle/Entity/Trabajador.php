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
}