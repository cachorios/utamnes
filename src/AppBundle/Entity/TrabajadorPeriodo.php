<?php
namespace AppBundle\Entity;

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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Liquidacion", mappedBy="trabajadorPeriodo")
     */
    private $liquidacion;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Periodo", inversedBy="trabajadorPeriodo")
     * @ORM\JoinColumn(name="periodo_id", referencedColumnName="id")
     */
    private $periodo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->liquidacion = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add liquidacion
     *
     * @param \AppBundle\Entity\Liquidacion $liquidacion
     * @return TrabajadorPeriodo
     */
    public function addLiquidacion(\AppBundle\Entity\Liquidacion $liquidacion)
    {
        $this->liquidacion[] = $liquidacion;

        return $this;
    }

    /**
     * Remove liquidacion
     *
     * @param \AppBundle\Entity\Liquidacion $liquidacion
     */
    public function removeLiquidacion(\AppBundle\Entity\Liquidacion $liquidacion)
    {
        $this->liquidacion->removeElement($liquidacion);
    }

    /**
     * Get liquidacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLiquidacion()
    {
        return $this->liquidacion;
    }

    /**
     * Set periodo
     *
     * @param \AppBundle\Entity\Periodo $periodo
     * @return TrabajadorPeriodo
     */
    public function setPeriodo(\AppBundle\Entity\Periodo $periodo = null)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get periodo
     *
     * @return \AppBundle\Entity\Periodo 
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }
}
