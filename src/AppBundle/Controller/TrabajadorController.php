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


/**
 * Trabajador controller.
 *
 * @Route("/app/trabajador")
 */
class TrabajadorController extends Controller
{

    /**
     * Lists all Trabajador entities.
     *
     * @Route("/", name="app_trabajador")
     * @Method("GET")
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

    /**
     * Displays a form to create a new Trabajador entity.
     *
     * @Route("/new", name="app_trabajador_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Trabajador();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Trabajador entity.
     *
     * @Route("/{id}", name="app_trabajador_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Trabajador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Trabajador entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Trabajador entity.
     *
     * @Route("/{id}/edit", name="app_trabajador_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Trabajador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Trabajador entity.');
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
     * Creates a form to edit a Trabajador entity.
     *
     * @param Trabajador $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Trabajador $entity)
    {
        $form = $this->createForm(
            new TrabajadorType(),
            $entity,
            array(
                'action' => $this->generateUrl('app_trabajador_update', array('id' => $entity->getId())),
                'method' => 'PUT',
            )
        );


        return $form;
    }

    /**
     * Edits an existing Trabajador entity.
     *
     * @Route("/{id}/edit", name="app_trabajador_update")
     * @Method("PUT")
     * @Template("AppBundle:Trabajador:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Trabajador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Trabajador entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $trabajadorModel = $this->get('uta.trabajadormodel');

            $trabajadorModel->guardar($entity);

            $this->get('session')->getFlashBag()->add('success', "El Trabajador $entity se actualizó correctamente.");

            return $this->redirect($this->generateUrl('app_trabajador'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Trabajador entity.
     *
     * @Route("/{id}", name="app_trabajador_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Trabajador')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Trabajador entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('app_trabajador'));
    }

    /**
     * Creates a form to delete a Trabajador entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_trabajador_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'Delete',
                    'attr' => array(
                        'class' => 'btn btn-danger btn-sm'
                    )
                )
            )
            ->getForm();
    }

}
