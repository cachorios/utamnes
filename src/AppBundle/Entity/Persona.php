<?php
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
     * @ORM\OneToMany(targetEntity="Trabajador", mappedBy="persona")
     */
    private $trabajador;
}