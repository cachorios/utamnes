<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/02/2015
 * Time: 23:47
 */

namespace AppBundle\Model;


use AppBundle\Entity\Empleador;
use AppBundle\Entity\Persona;
use AppBundle\Entity\TrabajadorConcepto;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use RBSoft\UsuarioBundle\Entity\Usuario;

class Trabajador
{
    protected $trabajador,
        $empleador,
        $persona,
        $conceptos;

    protected $em,
        $usuario;

    public function __construct(EntityManager $em, $token_st)
    {
        $this->em = $em;
        $this->usuario = $token_st->getToken()->getUser();

    }

    public function nuevo($legajo, Empleador $empleador, Persona $persona, Collection $conceptos = null)
    {
        $this->trabajador = new \AppBundle\Entity\Trabajador();
        $this->trabajador->setLegajo($legajo);
        $this->trabajador->setEmpleador($empleador);

        $this->persona = $persona;
        $this->conceptos = $conceptos;
    }

    public function guardar()
    {
        if ($this->validar()) {
            $this->em->beginTransaction();
            $this->em->persist($this->persona);
            $this->trabajador->setPersona($this->persona);
            $this->em->persist($this->trabajador);
            $this->asignarConceptos();

            $this->em->flush();
        } else {
            throw new \Exception ("Los datos no son validos.");
        }
    }

    private function asignarConceptos()
    {
        foreach ($this->conceptos as $concepto) {
            $aux = new TrabajadorConcepto($this->trabajador, $concepto, $this->usuario, new \DateTime("now"));
            $this->em->persist($aux);
        }
    }

    public function validar()
    {
        $conceptos = $this->em->getRepository('AppBundle:Concepto')->findBy(array('obligatorio' => true));
        foreach ($this->conceptos as $concepto) {
            if ($concepto->getObligatorio()) {
                foreach ($conceptos as $concObl) {
                    if ($concepto->getId() == $concObl->getId()) {
                        $conceptos->remove($concObl);
                        continue;
                    }
                }
            }
        }
        foreach ($conceptos as $concepto) {
            $this->conceptos->add($concepto);
        }

        return true;
    }

} 