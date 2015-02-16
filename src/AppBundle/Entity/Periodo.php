<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Periodo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Obligacion", mappedBy="periodo")
     */
    private $obligacion;

    /**
     * @ORM\OneToMany(targetEntity="TrabajadorPeriodo", mappedBy="periodo")
     */
    private $trabajadorPeriodo;
}