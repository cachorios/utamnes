<?php

namespace spec\AppBundle\Model;

require_once __DIR__.'/../../../vendor/autoload.php';
require_once __DIR__.'/../../../App/AppKernel.php';

use AppBundle\Entity\Empleador;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Tests\KernelTest;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

class EmpleadorModelSpec extends ObjectBehavior
{
    function let(ContainerInterface $container,SecurityContextInterface $sc, TokenInterface $token)
    {

        /*$kernel = new \AppKernel("test",true);
        $kernel->boot();
        $container = $kernel->getContainer();*/

        $container->get("security.context")->willReturn($sc);
        $sc->getToken()->willReturn($token);
        $token->getUser()->willReturn($user);
        $this->beConstructedWith($container);

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
