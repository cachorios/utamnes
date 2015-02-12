<?php
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
     * @ORM\ManyToOne(targetEntity="Empleador", inversedBy="trabajador")
     * @ORM\JoinColumn(name="empleador_id", referencedColumnName="id")
     */
    private $empleador;

    /**
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="trabajador")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     */
    private $persona;

    /**
     * @ORM\ManyToMany(targetEntity="Concepto", mappedBy="trabajador")
     */
    private $concepto;
}