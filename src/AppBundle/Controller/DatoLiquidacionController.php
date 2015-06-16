<?php

namespace AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @throws NotFoundHttpException
     * @return Response
     */
    public function datoEditAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $trabajador = $em->getRepository("AppBundle:Trabajador")->find($request->get("id"));

        $aImpportes = array();
        $aImpportes[0] = 12300;
        $aImpportes[1] = 10300;
        $aImpportes[3] = 2000;

        $aConceptos = $this->get("uta.empleador_activo")->getConceptos();

        $vista = $this->renderView("@App/DatoLiquidacion/datos_edit.html.twig",array(
            "trabajador"    => $trabajador,
            "importes"      => $aImpportes,
            "conceptos"     => $aConceptos
        ));

        $resp = new Response($vista);
        return $resp;
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