<?php
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Ctacte
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Concepto", inversedBy="ctacte")
     * @ORM\JoinColumn(name="concepto_id", referencedColumnName="id")
     */
    private $concepto;

    /**
     * @ORM\ManyToOne(targetEntity="Obligacion", inversedBy="ctacte")
     * @ORM\JoinColumn(name="obligacion_id", referencedColumnName="id")
     */
    private $obligacion;
}