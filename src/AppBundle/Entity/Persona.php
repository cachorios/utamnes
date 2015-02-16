<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Persona
{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=11, nullable=false)
     */
    private $cuil;

    /**
     * @ORM\Column(type="string", length=64, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=128, nullable=false)
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
     * @ORM\Column(type="string", length=1, nullable=false)
     */
    private $sexo;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $localidad;

    /**
     * @ORM\Column(type="string", length=1, nullable=false)
     */
    private $estado_civil;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_actualizacion;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="Trabajador", mappedBy="persona")
     */
    private $trabajador;
    /**
     * @ORM\ManyToOne(targetEntity="Empleador", inversedBy="persona")
     * @ORM\JoinColumn(name="empleador_id", referencedColumnName="id")
     */
    private $empleador;
}
