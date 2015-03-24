<?php

namespace spec\AppBundle\Model;

//require_once __DIR__ . '/../../../../../app/bootstrap.php.cache';
//require_once __DIR__ . '/../../../../../app/AppKernel.php';

use AppBundle\Entity\Trabajador;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use RBSoft\UtilidadBundle\Libs\SfContaineForSpec;

class TrabajadorModelSpec extends ObjectBehavior
{
    use SfContaineForSpec;

    function let()
    {

        $this->autenticar('20204894532');

        $this->beConstructedWith(
            $this->container->get("doctrine.orm.entity_manager"),
            $this->container->get("uta.empleador_activo")

        );
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Model\TrabajadorModel');
    }

    function it_check_conceptos(){
        $this->getConceptosObligatorios()->shouldHaveCount(2);
    }


    function it_crear_trabajador(){
        $this->borrarTrabajador(1414);

        $trabajador = new Trabajador();

        $trabajador
            ->setCuil(1414)
            ->setNombre("Cabrera Facundo")
            ->setTelefono("4475646")
            ->setDireccion("Ch 113")
            ->setEstadoCivil("S")
            ->setLegajo("3279")
            ->setSexo("M")
            ->setFechaIngreso(new \DateTime("2012-01-10"))
            ->setLocalidad("Posadas");

        $this->guardar($trabajador)->shouldBe(true);
    }

    private function borrarTrabajador($cuil){
        $em=$this->container->get("doctrine.orm.entity_manager");
        $trab = $em->getRepository("AppBundle:Trabajador")->findOneByCuil($cuil);
        if($trab) {
            $em->remove($trab);
            $em->flush();
        }
    }

    function it_actualizar_trabajador_existente(){
        $em=$this->container->get("doctrine.orm.entity_manager");
        $trab = $em->getRepository("AppBundle:Trabajador")->findOneByCuil('1414');
        $this->guardar($trab)->shouldBe(true);


    }
}
