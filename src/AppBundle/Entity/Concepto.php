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
}