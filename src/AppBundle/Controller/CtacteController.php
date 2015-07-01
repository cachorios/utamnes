<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 21/06/2015
 * Time: 12:30 PM
 */

namespace AppBundle\Controller;


use JasperPHP\JasperPHP;
use RBSoft\UtilidadBundle\Libs\Util;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CtacteController
 * @package AppBundle\Controller
 * @Route("app/ctacte")
 * @Template
 */
class CtacteController extends Controller
{

    /**
     * @return array
     * @Route("/", name="ctacte")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $ctactes = $em->getRepository("AppBundle:Ctacte")->getCtactesQB(
            $this->get("uta.empleador_activo")->getEmpleador()
        )
            ->getQuery()
            ->execute();

        return array("ctactes" => $ctactes);
    }

    /**
     * @Route("/imprimir_boleta", name="imprimir_boleta")
     * @param Request $request
     */

    public function imprimirBoletaAction(Request $request)
    {
        $emp = $this->get("uta.empleador_activo");
        $empleador_id = $emp->getEmpleador()->getId();
        $periodo_id = $request->get("periodo_id", $emp->getPeriodoActivo()->getId() );

        $base = $this->get('kernel')->getRootDir() . '/..';
        $file = uniqid("boleta_{$empleador_id}_{$periodo_id}");

        /*
        $rbrep = $this->get("rb.reporte");

        $rbrep->procesar(
            $base."/reportes/boleta_banco.jrxml",
            array(
                "empleador-id" => $empleador_id,
                "periodo_id" => $periodo_id,
                "SUBREPORT_DIR" => $base.'/reportes'
            ),
            array(
                "tipo"      => "mysql",
                "database"  => "utamnes",
                "user"      => "root",
                "password"  => "7219"
            ),
            $base."/web/uploads/".$file.".pdf"
        );
        */

        $jr = new JasperPHP();

        $jr->compile(
            $base.'/reportes/boleta_banco.jrxml',
            $base.'/web/uploads')
            ->execute();

        $file = uniqid("boleta_{$empleador_id}_{$periodo_id}");

//        ld( $base.'reportes/boleta_banco.jasper',$base.'web/uploads/'.$file);
        $jr->process(
            $base.'/web/uploads/boleta_banco.jasper',
            $base.'/web/uploads/'.$file,
            array("pdf"),
            array(
                "empleador_id"  => $empleador_id,
                "periodo_id"    => $periodo_id,
                "SUBREPORT_DIR" => $base.'/reportes'
            ),
            array(
                'driver'    => 'mysql',
                'host'      => "127.0.0.1",
                'database'  => 'utamnes',
                'username'  => 'root',
                'password'  => '7219'
    )
        )->execute();

        $cont = true;
        $time = Util::microtime_float();
        while($cont){

            if(file_exists($base.'/web/uploads/'.$file.".pdf") || (Util::microtime_float() - $time) > 10  ){
                $cont = false;
            }
        }
        $time = Util::microtime_float();
//        while((Util::microtime_float() - $time) < 2){
//            ///ld(Util::microtime_float() - $time);
//        }
        //ld($base.'/web/uploads/'.$file.".pdf");
        file_get_contents($base.'/web/uploads/'.$file.".pdf");

        return array(
            "titulo" => "Boleta para Pago en Banco: Periodo: " . $emp->getPeriodoActivo() ,
            "pdf"    => "uploads/".$file.".pdf"
        );

    }
}