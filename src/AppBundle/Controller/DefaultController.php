<?php

namespace AppBundle\Controller;


use JasperPHP\JasperPHP;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {



        $jr = new JasperPHP();

        $base = $this->get('kernel')->getRootDir() . '/../web';

        $jr->compile($base.'/boleta_bco.jrxml')->execute();

        $jr->process(
            $base.'/boleta_bco.jasper',
            $base.'/uploads',
            array("pdf"),
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
