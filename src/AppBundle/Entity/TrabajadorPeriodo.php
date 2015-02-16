<?php
<<<<<<< HEAD
=======
namespace AppBundle\Entity;
>>>>>>> 3c1926b9fef51f4a4a60f4dcfe06918d0c639709
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
<<<<<<< HEAD

    /**
     * @ORM\ManyToOne(targetEntity="TrabajadorConcepto", inversedBy="trabajadorPeriodo")
     * @ORM\JoinColumn(name="empleador_concepto_id", referencedColumnName="id")
     */
    private $empleadorConcepto;
}
=======
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
>>>>>>> 3c1926b9fef51f4a4a60f4dcfe06918d0c639709
