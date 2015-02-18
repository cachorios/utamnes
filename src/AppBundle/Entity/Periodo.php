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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Obligacion", mappedBy="periodo")
     */
    private $obligacion;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\TrabajadorPeriodo", mappedBy="periodo")
     */
    private $trabajadorPeriodo;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->obligacion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->trabajadorPeriodo = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Add obligacion
     *
     * @param \AppBundle\Entity\Obligacion $obligacion
     * @return Periodo
     */
    public function addObligacion(\AppBundle\Entity\Obligacion $obligacion)
    {
        $this->obligacion[] = $obligacion;

        return $this;
    }

    /**
     * Remove obligacion
     *
     * @param \AppBundle\Entity\Obligacion $obligacion
     */
    public function removeObligacion(\AppBundle\Entity\Obligacion $obligacion)
    {
        $this->obligacion->removeElement($obligacion);
    }

    /**
     * Get obligacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getObligacion()
    {
        return $this->obligacion;
    }

    /**
     * Add trabajadorPeriodo
     *
     * @param \AppBundle\Entity\TrabajadorPeriodo $trabajadorPeriodo
     * @return Periodo
     */
    public function addTrabajadorPeriodo(\AppBundle\Entity\TrabajadorPeriodo $trabajadorPeriodo)
    {
        $this->trabajadorPeriodo[] = $trabajadorPeriodo;

        return $this;
    }

    /**
     * Remove trabajadorPeriodo
     *
     * @param \AppBundle\Entity\TrabajadorPeriodo $trabajadorPeriodo
     */
    public function removeTrabajadorPeriodo(\AppBundle\Entity\TrabajadorPeriodo $trabajadorPeriodo)
    {
        $this->trabajadorPeriodo->removeElement($trabajadorPeriodo);
    }

    /**
     * Get trabajadorPeriodo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrabajadorPeriodo()
    {
        return $this->trabajadorPeriodo;
    }
}
