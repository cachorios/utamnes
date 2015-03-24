<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/02/2015
 * Time: 23:47
 */

namespace AppBundle\Model;


use AppBundle\Entity\Empleador;
use AppBundle\Entity\TrabajadorConcepto;
use AppBundle\Servicios\EmpleadorActivo;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use RBSoft\UsuarioBundle\Entity\Usuario;
use RBSoft\UtilidadBundle\Libs\Util;
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

    public function __construct(EntityManager $em , EmpleadorActivo $empleadorActivo)
    {
        $this->em = $em;
        $this->empleador = $empleadorActivo->getEmpleador();

    }

    public function iniciar(\AppBundle\Entity\Trabajador $trabajador,  $conceptos)
    {
        $this->trabajador = $trabajador;
        $this->conceptos = $conceptos;
    }


    /*public function guardar()
    {
        $ok = false;

        /**
         * Datos de la modificacion para auditoria
         */
    /*
        $this->trabajador->setFechaActualizacion(new \DateTime("now"));
        $this->trabajador->setUsuario($this->empleador->getUsuario());

        $this->em->beginTransaction();
        try {
            if (!$this->asignarConceptos()) {
                throw new \Exception("No se asigno conceptos.");
            }

            $this->trabajador->setEmpleador($this->empleador);

            $this->em->persist($this->trabajador);
            $this->em->flush();
            $this->em->commit();
            $ok = true;
        } catch (\Exception $e) {
            $this->em->rollback();
            $this->em->close();

        }

        return $ok;
    }*/



    /**
     *
     */
   /* private function asignarConceptos()
    {
        $ok = false;
        $this->agregarConceptosObligatorios();
        foreach ($this->conceptos as $concepto) {
            $this->trabajador->addConcepto($concepto);
            $ok = true;
        }

        return $ok;
    }*/

    /**
     * @return bool
     */
    /*
    public function agregarConceptosObligatorios()
    {
        $conceptos = $this->getConceptosObligatorios();

        foreach ($this->conceptos as $concepto) {
            if ($concepto->getObligatorio()) {
                foreach ($conceptos as $i => $concObl) {
                    if ($concepto->getId() == $concObl->getId()) {
                        unset($conceptos[$i]);
                        continue;
                    }
                }
            }
        }

        foreach ($conceptos as $concepto) {
            $this->conceptos->add($concepto);
        }

        return $this->conceptos->count() >= 2;
    }
/*
    /**
     * @return \Doctrine\Common\Collections\Collection
     */
/*
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
*/
} 