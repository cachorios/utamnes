<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Empleador
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Trabajador", mappedBy="empleador")
     */
    private $trabajador;
    /**
     * @ORM\Column(type="string", length=64, nullable=false)
     */
    private $razon;

    /**
     * @ORM\Column(type="string", length=11, nullable=false)
     */
    private $cuit;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $localidad;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_actualizacion;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $usuario;
}