<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TestController extends Controller
{
    /**
     * @Route("/test")
     * @Template()
     */
    public function testAction()
    {
        $modTrabajador = $this->container->get('uta.trabajador');
        ladybug_dump_die($modTrabajador);
        return array(
                // ...
            );    }

}
