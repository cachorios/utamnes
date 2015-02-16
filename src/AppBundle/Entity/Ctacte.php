<?php
<<<<<<< HEAD
=======
namespace AppBundle\Entity;
>>>>>>> 3c1926b9fef51f4a4a60f4dcfe06918d0c639709
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
<<<<<<< HEAD
}
=======

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
     * Set concepto
     *
     * @param \AppBundle\Entity\Concepto $concepto
     * @return Ctacte
     */
    public function setConcepto(\AppBundle\Entity\Concepto $concepto = null)
    {
        $this->concepto = $concepto;

        return $this;
    }

    /**
     * Get concepto
     *
     * @return \AppBundle\Entity\Concepto 
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * Set obligacion
     *
     * @param \AppBundle\Entity\Obligacion $obligacion
     * @return Ctacte
     */
    public function setObligacion(\AppBundle\Entity\Obligacion $obligacion = null)
    {
        $this->obligacion = $obligacion;

        return $this;
    }

    /**
     * Get obligacion
     *
     * @return \AppBundle\Entity\Obligacion 
     */
    public function getObligacion()
    {
        return $this->obligacion;
    }
}
>>>>>>> 3c1926b9fef51f4a4a60f4dcfe06918d0c639709
