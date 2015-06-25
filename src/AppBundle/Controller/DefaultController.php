<?php

namespace AppBundle\Controller;


use JasperPHP\JasperPHP;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        $jr = new JasperPHP();


        $jr->compile('boleta_bco.jrxml')->execute();

        $jr->process(
            'boleta_bco.jasper',
            false,
            array("pdf", "rtf"),
            array(),
            array(
                'driver'    => 'mysql',
                'host'      => "localhost",
                'database'  => 'utamnes',
                'username'  => 'root',
                'password'  => '7219'
    )
        )->execute();
//
//        $jr->process(
//            'boleta_bco.jasper',
//            false,
//            array("pdf", "rtf"),
//            array("php_version" => phpversion())
//        )->execute();

//        $jr->process("F:/web/utamnes/web/hello_world.jrxml",
//            "F:/web/utamnes/web/uploads",array("pdf"),array(),array(),true,true);


        return $this->render('@App/Default/index.html.twig');
    }
}
