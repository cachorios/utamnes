<?php
namespace AppBundle\Entity;

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

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set trabajadorPeriodo
     *
     * @param \AppBundle\Entity\TrabajadorPeriodo $trabajadorPeriodo
     * @return Liquidacion
     */
    public function setTrabajadorPeriodo(\AppBundle\Entity\TrabajadorPeriodo $trabajadorPeriodo = null)
    {
        $this->trabajadorPeriodo = $trabajadorPeriodo;

        return $this;
    }

    /**
     * Get trabajadorPeriodo
     *
     * @return \AppBundle\Entity\TrabajadorPeriodo 
     */
    public function getTrabajadorPeriodo()
    {
        return $this->trabajadorPeriodo;
    }
}
