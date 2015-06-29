<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 21/06/2015
 * Time: 12:30 PM
 */

namespace AppBundle\Controller;


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

        $base = $this->get('kernel')->getRootDir() . '/../';
        $rbrep = $this->get("rb.reporte");

        $rbrep->procesar(
            $base."reportes/boleta_banco.jrxml",
            array(
                "empleador-id" => $empleador_id,
                "periodo_id" => $periodo_id
            ),
            array(
                "tipo"      => "mysql",
                "database"  => "utamnes",
                "user"      => "root",
                "password"  => "7219"
            ),
            $base."web/uploads/boleta_{$empleador_id}_{$periodo_id}.pdf"
        );

        return array(
            "titulo" => "Boleta para Pago en Banco: Periodo: " . $emp->getPeriodoActivo() ,
            "pdf"    => "uploads/boleta_{$empleador_id}_{$periodo_id}.pdf"
        );

    }
}