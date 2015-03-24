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


    function it_crear_trabajador(){
        $trabajador = new Trabajador();
        $trabajador
            ->setCuil(1414)
            ->setNombre("Cabrera Facundo")
            ->setTelefono("4475646")
            ->setDireccion("Ch 113")
            ->setEstadoCivil("S")
            ->setLegajo("3279")
            ->setLocalidad("Posadas");


    }
}
