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

class Trabajador {
    protected   $trabajador,
                $empleador,
                $persona,
                $condeptos;

    protected   $em,
                $usuario;

    public function __construct(EntityManager $em,Usuario $usuario)
    {
        $this->em = $em;
        $this->usuario = $usuario;

    }
    public  function nuevo($cuil=null,$legajo =null,Empleador $empleador =null,Persona $persona =null,Collection $conceptos =null)
    {
        $this->trabajador= new \AppBundle\Entity\Trabajador();
        $this->trabajador->setCuil($cuil);
        $this->trabajador->setLegajo($legajo);
        $this->trabajador->setEmpleador($empleador);

        $this->persona = $persona;
        $this->condeptos = $conceptos;
    }

    public  function guardar()
    {
        if($this->validar()){
            $this->em->beginTransaction();
            $this->em->persist($this->persona);
            $this->trabajador->setPersona($this->persona);
            $this->em->persist($this->trabajador);
            $this->asignarConceptos();

            $this->em->flush();
        }else{
            throw new \Exception ("Los datos no son validos.");
        }
    }

    private function asignarConceptos()
    {
        foreach($this->condeptos as $concepto){
            $aux = new TrabajadorConcepto($this->trabajador, $concepto, $this->usuario, new \DateTime("now"));
            $this->em->persist($aux);
        }
    }

    public function validar()
    {
        return true;

    }

} 