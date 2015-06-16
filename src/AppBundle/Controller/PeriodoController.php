<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Knp\Component\Pager\Paginator;

use AppBundle\Entity\Periodo;
use AppBundle\Form\PeriodoType;
use AppBundle\Form\PeriodoFilterType;
use Symfony\Component\HttpFoundation\Response;


/**
 * Periodo controller.
 *
 * @Route("/app/periodo")
 */
class PeriodoController extends Controller
{

    /**
     * Lists all Periodo entities.
     *
     * @Route("/", name="app_periodo")
     * @ Method("GET")
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
        $filterForm = $this->createForm(new PeriodoFilterType());

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Periodo')->createQueryBuilder("q");

        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('submit-filter') == 'reset') {
            $session->remove('PeriodoControllerFilter');
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
                $session->set('PeriodoControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('PeriodoControllerFilter')) {
                $filterData = $session->get('PeriodoControllerFilter');
                $filterForm = $this->createForm(new PeriodoFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }
        return array($filterForm, $queryBuilder);
    }

    /**
     * Creates a new Periodo entity.
     *
     * @Route("/new", name="app_periodo_create")
     * @Method("POST")
     * @Template("AppBundle:Periodo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Periodo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setEmpleador($this->get('uta.empleador_activo')->getEmpleador());
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', "El Periodo $entity se creó correctamente.");
            if ($request->request->get('save_mode') == 'save_and_close') {
                return $this->redirect($this->generateUrl('app_periodo'));
            }
            return $this->redirect($this->generateUrl('app_periodo_new'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Periodo entity.
     *
     * @param Periodo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Periodo $entity)
    {
        $form = $this->createForm(new PeriodoType(), $entity, array(
            'action' => $this->generateUrl('app_periodo_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new Periodo entity.
     *
     * @Route("/new", name="app_periodo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Periodo();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Periodo entity.
     *
     * @Route("/{id}/show", name="app_periodo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Periodo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Periodo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Periodo entity.
     *
     * @Route("/{id}/edit", name="app_periodo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Periodo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Periodo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Periodo entity.
     *
     * @param Periodo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Periodo $entity)
    {
        $form = $this->createForm(new PeriodoType(), $entity, array(
            'action' => $this->generateUrl('app_periodo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }

    /**
     * Edits an existing Periodo entity.
     *
     * @Route("/{id}/edit", name="app_periodo_update")
     * @Method("PUT")
     * @Template("AppBundle:Periodo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Periodo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Periodo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', "El Periodo $entity se actualizó correctamente.");
            return $this->redirect($this->generateUrl('app_periodo'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Periodo entity.
     *
     * @Route("/{id}", name="app_periodo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Periodo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Periodo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('app_periodo'));
    }

    /**
     * Creates a form to delete a Periodo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_periodo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'Delete',
                'attr' => array(
                    'class' => 'btn btn-danger btn-sm'
                )
            ))
            ->getForm();
    }

    /**
     * @param $periodo
     * @Route("/check" , name="periodo_check")
     */
    public function checkPeriodoAction(Request $request)
    {
        $periodo = $request->get("periodo");

//        if(!(floor($periodo/100 <= date("Y"))))
        $em = $this->getDoctrine()->getManager();
        $num = $em->getRepository("AppBundle:Periodo")->getLiquidaciones($this->get('uta.empleador_activo')->getEmpleador(), $periodo);

//        ld($periodo,$num);
        return new Response(json_encode(array("numero" => $num)));
    }

}
