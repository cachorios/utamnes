<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Obligacion
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Ctacte", mappedBy="obligacion")
     */
    private $ctacte;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Periodo", inversedBy="obligacion")
     * @ORM\JoinColumn(name="periodo_id", referencedColumnName="id")
     */
    private $periodo;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ctacte = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add ctacte
     *
     * @param \AppBundle\Entity\Ctacte $ctacte
     * @return Obligacion
     */
    public function addCtacte(\AppBundle\Entity\Ctacte $ctacte)
    {
        $this->ctacte[] = $ctacte;

        return $this;
    }

    /**
     * Remove ctacte
     *
     * @param \AppBundle\Entity\Ctacte $ctacte
     */
    public function removeCtacte(\AppBundle\Entity\Ctacte $ctacte)
    {
        $this->ctacte->removeElement($ctacte);
    }

    /**
     * Get ctacte
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCtacte()
    {
        return $this->ctacte;
    }

    /**
     * Set periodo
     *
     * @param \AppBundle\Entity\Periodo $periodo
     * @return Obligacion
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
