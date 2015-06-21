<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 19/06/2015
 * Time: 11:49 PM
 */

namespace AppBundle\Controller;


use AppBundle\Libs\Liquidar;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Tg\DemoStreamBundle\Helper\FlushHelper;

/**
 * Class LiquidarController
 * @package AppBundle\Controller
 * @Route("/app/liquidar")
 */
class LiquidarController extends Controller
{

    /**
     * @Route("/", name="liquidar" )
     * @Template
     * @return array
     */
    public function liquidarAction()
    {
        $emp = $this->get("uta.empleador_activo");

        return Array("periodo" => $emp->getPeriodoActivo());

    }

    /**
     * @Route("/liquidar", name="liquidarprocess")
     * @return StreamedResponse
     */
    public function liquidarprocessAction(Request $request)
    {

        $trabModel = $this->get("uta.trabajadormodel");
        $emp = $this->get("uta.empleador_activo");

        $helper = new FlushHelper();

        $liquidar = new Liquidar($emp,$trabModel);


        return new StreamedResponse(function () use ($helper, $liquidar, $emp) {

            $top = $this->renderView('@App/Liquidar/gaugeLiquidacion.html.twig', array('periodo' =>   $emp->getPeriodoActivo()));
            $helper->out($top);

            $liquidar->procesar($helper);


        });

    }
}