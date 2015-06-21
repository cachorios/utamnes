<?php

namespace AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Proxies\__CG__\AppBundle\Entity\Periodo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Knp\Component\Pager\Paginator;

use AppBundle\Entity\Trabajador;
use AppBundle\Form\TrabajadorType;
use AppBundle\Form\TrabajadorFilterType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfToken;


/**
 * DatoLiquidacion controller.
 *
 * @Route("/app/liquidaciondato")
 */
class DatoLiquidacionController extends Controller
{

    /**
     * Lists all Trabajador entities.
     *
     * @Route("/", name="liquidaciondato")
     * @Method("GET|POST")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        list($filterForm, $queryBuilder) = $this->filter($request);
        $pager = $this->getPager($queryBuilder);

        return array(
            'pager' => $pager,
            'filterform' => $filterForm->createView(),
        );
    }

    /**
     * Crea el paginador Pagerfanta
     * @param Request $request
     * @return SlidingPagination
     * @throws NotFoundHttpException
     */
    private function getPager($q)
    {
        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $q,
            $this->get('request')->query->get('page', 1)/*page number*/,
            8,/*limit per page*/
            array('distinct' => false)
        );

        return $pagination;

    }

    private function filter(Request $request)
    {
        $session = $request->getSession();
        $filterForm = $this->createForm(new TrabajadorFilterType());

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Trabajador')->createQueryBuilder("q");

        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('submit-filter') == 'reset') {
            $session->remove('TrabajadorControllerFilter');
        }

        // Filter action
        if ($request->getMethod() == 'POST' && $request->get('submit-filter') == 'Aplicar') {
            // Bind values from the request
            //$filterForm->bind($request);
            $filterForm->handleRequest($request);

            if ($filterForm->isValid()) {
                // Build the query from the given form object
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('TrabajadorControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('TrabajadorControllerFilter')) {
                $filterData = $session->get('TrabajadorControllerFilter');
                $filterForm = $this->createForm(new TrabajadorFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }

        return array($filterForm, $queryBuilder);
    }

    /**
     * @param Request $request
     * @Route("/datoedit", name="datoedit")
     * @Method("GET|POST")
     * @throws NotFoundHttpException
     * @return Response
     */
    public function datoEditAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $trabModel= $this->get("uta.trabajadormodel");
        $trabModel->setTrabajadorId($request->get("id"));

        $emp_activo = $this->get("uta.empleador_activo");
        $periodo = $emp_activo->getPeriodoActivo();


        if($request->getMethod()=="POST"){

            $datosliq =  $request->get("datosliq");
            $dato_valor =  $request->get("dato_valor");
            $tk =  $request->get("_csrf_token");

            if($this->get("security.csrf.token_manager")->isTokenValid(new CsrfToken("datosliq", $tk))){
                $liqs = $trabModel->liquidar($periodo,$datosliq, $dato_valor);
                $trabModel->liquidacionSave($periodo,$liqs, $datosliq);
                $estado = array('estado' => 'success','msg'=>'La liquidación guardó con éxito');
            }else{
                $estado = array('estado' => "error","msg"=>"Error de formulario, requiere un token valido");

            }

            return new Response(json_encode($estado));

        }


        $vista = $this->renderView("@App/DatoLiquidacion/datos_edit.html.twig",array(
            "trabajador"    => $trabModel->getTrabajador(),
            "importes"      => $trabModel->getArrayDatosImporte($periodo),
            "liquidacion"   => $trabModel->getLiquidacion($periodo),
            "csrf_token"    => $this->get("security.csrf.token_manager")->getToken("datosliq")
        ));

        $resp = new Response($vista);
        return $resp;
    }

    /**
     * @Route("/liquidar_trabajador", name="liquidar_trabajador")
     * @param Request $request
     */
    public function liquidarAction(Request $request){
        $trabModel= $this->get("uta.trabajadormodel");
        $trabModel->setTrabajadorId($request->get("id"));

        $emp_activo = $this->get("uta.empleador_activo");
        $periodo = $emp_activo->getPeriodoActivo();

        $datosliq =  $request->get("datosliq");
        $dato_valor =  $request->get("dato_valor");

        $liqs = $trabModel->Liquidar($periodo,$datosliq, $dato_valor);
        $ret = array();
        $suma= 0;
        foreach($liqs as $liq){
            $suma += $liq->getImporte();
            $ret['valor'][$liq->getConcepto()->getNumero()] = number_format($liq->getImporte(),2,',','.');
        }
        $ret['total'] = number_format($suma,2,',','.');

        return new Response(json_encode($ret));
    }




    /**
     * Creates a new Trabajador entity.
     *
     * @Route("/new", name="app_trabajador_create")
     * @Method("POST")
     * @Template("AppBundle:Trabajador:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Trabajador();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $trabajadorModel = $this->get('uta.trabajadormodel');
            $trabajadorModel->guardar($entity);

            $this->get('session')->getFlashBag()->add('success', "El Trabajador $entity se creó correctamente.");
            if ($request->request->get('save_mode') == 'save_and_close') {
                return $this->redirect($this->generateUrl('app_trabajador'));
            }

            return $this->redirect($this->generateUrl('app_trabajador_new'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Trabajador entity.
     *
     * @param Trabajador $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Trabajador $entity)
    {
        $form = $this->createForm(
            new TrabajadorType(),
            $entity,
            array(
                'action' => $this->generateUrl('app_trabajador_create'),
                'method' => 'POST',
            )
        );


        return $form;
    }



}
