<?php

namespace spec\AppBundle\Model;



require_once __DIR__ . '/../../../../../app/bootstrap.php.cache';
require_once __DIR__ . '/../../../../../app/AppKernel.php';

use AppBundle\Entity\Empleador;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;


class EmpleadorModelSpec extends ObjectBehavior
{
    private $container;
    function let()
    {

        $kernel = new \AppKernel("dev",true);
        $kernel->loadClassCache();
        $kernel->init();
        $kernel->boot();
        $this->container = $kernel->getContainer();

        $this->autenticar();
        $this->EliminarEmpleador();
        $this->beConstructedWith($this->container);

    }

    /**
     * Para poder repetir el test debo eliminar el registro
     */
    private function eliminarEmpleador(){
        $em = $this->container->get("doctrine.orm.entity_manager");
        $empl = $em->getRepository("AppBundle:Empleador")->findOneByCuit(151589);

        if(!$empl == null){
            $em->remove($empl);
            $em->flush();
        }



    }
    private function autenticar(){
        //$session = $this->container->get('session');

        $user = $this->container->get('fos_user.user_manager')->findUserByUsername("20204894532");
        $providerKey = $this->container->getParameter('fos_user.firewall_name');

        $token = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());

        $sc = $user = $this->container->get('security.context');
        $sc->setToken($token);
        //$session->set('_security_'.$providerKey, serialize($token));

       // $session->save();

    }



    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Model\EmpleadorModel');
    }

    function it_crear_un_empleador(){
        $empl = new Empleador();
        $empl->setCuit(151589)
            ->setRazon("Nico")
            ->setEmail("nicobc@gmail.com")
            ->setDireccion("aa")
            ->setTelefono("111")
            ->setLocalidad("Posadas");
        $this->setEmpleador($empl)->shouldReturn($this);

        $this->guardar()->shouldReturn(true);
    }

}
