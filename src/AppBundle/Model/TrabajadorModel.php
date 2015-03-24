<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/02/2015
 * Time: 23:47
 */

namespace AppBundle\Model;


use AppBundle\Entity\Empleador;
use AppBundle\Entity\Trabajador;
use AppBundle\Entity\TrabajadorConcepto;
use AppBundle\Servicios\EmpleadorActivo;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContextInterface;


class TrabajadorModel
{

    /**
     * @var \AppBundle\Entity\Trabajador
     */
    protected $trabajador;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $conceptos;

    protected $em;
    /**
     * @var \AppBundle\Entity\Empleador
     */
    protected $empleador;

    public function __construct(EntityManager $em, EmpleadorActivo $empleadorActivo)
    {
        $this->em = $em;
        $this->empleador = $empleadorActivo->getEmpleador();

    }

    public function iniciar(\AppBundle\Entity\Trabajador $trabajador, $conceptos)
    {
        $this->trabajador = $trabajador;
        $this->conceptos = $conceptos;
    }


    /**
     * @return \Doctrine\Common\Collections\Collection
     */

        public function getConceptosObligatorios()
        {

            $conceptos = $this->em->getRepository('AppBundle:Concepto')
                ->findBy(
                    array(
                        'obligatorio' => true,
                        'activo' => true
                    )
                );


            return $conceptos;
        }


    public function guardar(Trabajador $trabajador, $conceptos_original = null)
    {

        $this->asignarConceptosObligatorios($trabajador);

        $this->em->beginTransaction();

        try {
            $trabajador->setFechaActualizacion(new \DateTime("now"));
            $trabajador->setUsuario($this->empleador->getUsuario());

            $trabajador->setEmpleador($this->empleador);
            $this->em->persist($trabajador);
            $this->em->flush();
            $this->em->commit();

        } catch (\Exception $e) {
            $this->em->rollback();
            $this->em->close();
            throw new \Exception($e->getMessage());

        }

        return true;
    }



    private function asignarConceptosObligatorios(Trabajador $trabajador){
        $obls= $this->getConceptosObligatorios();

        foreach($obls as $obl){
            $trabajador->addConcepto($obl);
        }

    return $trabajador->getConceptos();
    }

}
