<?php
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
     * @ORM\OneToMany(targetEntity="Ctacte", mappedBy="concepto")
     */
    private $ctacte;

    /**
     * @ORM\ManyToMany(targetEntity="Trabajador", inversedBy="concepto")
     * @ORM\JoinTable(
     *     name="TrabajadorConcepto",
     *     joinColumns={@ORM\JoinColumn(name="concepto_id", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="trabajador_id", referencedColumnName="id", nullable=false)}
     * )
     */
    private $trabajador;
}