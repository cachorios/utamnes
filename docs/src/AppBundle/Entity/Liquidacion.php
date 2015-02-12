<?php
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Liquidacion
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="TrabajadorPeriodo", inversedBy="liquidacion")
     * @ORM\JoinColumn(name="trabajador_periodo_id", referencedColumnName="id")
     */
    private $trabajadorPeriodo;
}