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
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use RBSoft\UsuarioBundle\Entity\Usuario;
use RBSoft\UtilidadBundle\Libs\Util;


class Trabajador{

    /**
     * @var \AppBundle\Entity\Trabajador
     */
    protected $trabajador;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $conceptos;

    protected $em, $usuario;

    public function __construct(EntityManager $em, $token_st)
    {
        $this->em = $em;
//        if($token_st->getToken())
            $this->usuario = $token_st->getToken()->getUser();
//        else
//            $this->usuario = null;
    }

    public function iniciar(\AppBundle\Entity\Trabajador $trabajador, Collection $conceptos = null)
    {
        $this->trabajador = $trabajador;
        $this->conceptos = $conceptos;
    }


    public function guardar()
    {
        $ok = false;

        /**
         * Datos de la modificacion para auditoria
         */
        $this->trabajador->setFechaActualizacion(new \DateTime("now"));
        $this->trabajador->setUsuario($this->usuario);

        $this->em->beginTransaction();
        try {
            if(!$this->asignarConceptos())
                throw new \Exception("No se asigno conceptos.");

            $this->em->persist($this->trabajador);
            $this->em->flush();
            $this->em->commit();
            $ok = true;
        }catch (\Exception $e){
            echo "\n".$e->getMessage();
            $this->em->rollback();
            $this->em->close();

        }

        return $ok;
    }

    /**
     * @return \AppBundle\Entity\Trabajador
     */
    private function getTrabajador(){
        return $this->trabajador;
    }

    /**
     *
     */
    private function asignarConceptos()
    {
        $ok = false;
        $this->agregarConceptosObligatorios();
        foreach ($this->conceptos as $concepto) {
            $this->trabajador->addConcepto($concepto);
            $ok = true;
        }
        return $ok;
    }

    /**
     * @return bool
     */
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


        return $this->conceptos->count()  >=2;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */

    public function getConceptosObligatorios()
    {

        $conceptos = $this->em->getRepository('AppBundle:Concepto')
            ->findBy(array(
                    'obligatorio' => true,
                    'activo' => true)
        );


        return $conceptos;
    }

} 