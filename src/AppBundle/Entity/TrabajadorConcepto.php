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
}