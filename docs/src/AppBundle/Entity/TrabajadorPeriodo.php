<?php
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class TrabajadorPeriodo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Liquidacion", mappedBy="trabajadorPeriodo")
     */
    private $liquidacion;

    /**
     * @ORM\ManyToOne(targetEntity="Periodo", inversedBy="trabajadorPeriodo")
     * @ORM\JoinColumn(name="periodo_id", referencedColumnName="id")
     */
    private $periodo;

    /**
     * @ORM\ManyToOne(targetEntity="TrabajadorConcepto", inversedBy="trabajadorPeriodo")
     * @ORM\JoinColumn(name="empleador_concepto_id", referencedColumnName="id")
     */
    private $empleadorConcepto;
}