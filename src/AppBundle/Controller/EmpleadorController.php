<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Knp\Component\Pager\Paginator;

use AppBundle\Entity\Empleador;
use AppBundle\Form\EmpleadorType;
use AppBundle\Form\EmpleadorFilterType;




/**
 * Empleador controller.
 *
 * @Route("/admin/empleador")
 */
class EmpleadorController extends Controller
{

    /**
     * Lists all Empleador entities.
     *
     * @Route("/", name="admin_empleador")
     * @ Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
    list($filterForm, $queryBuilder) = $this->filter($request);
    $pager = $this->getPager($queryBuilder);

        return array(
            'pager'         => $pager,
            'filterform'    => $filterForm->createView(),
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
        $paginator  = $this->get('knp_paginator');

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
        $filterForm = $this->createForm(new EmpleadorFilterType());

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Empleador')->createQueryBuilder("q");

        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('submit-filter') == 'reset') {
            $session->remove('EmpleadorControllerFilter');
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
                $session->set('EmpleadorControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('EmpleadorControllerFilter')) {
                $filterData = $session->get('EmpleadorControllerFilter');
                $filterForm = $this->createForm(new EmpleadorFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
           }
        }
        return array($filterForm, $queryBuilder);
    }

    /**
     * Creates a new Empleador entity.
     *
     * @Route("/new", name="admin_empleador_create")
     * @Method("POST")
     * @Template("AppBundle:Empleador:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Empleador();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success',"El Empleador $entity se creó correctamente.");
            if ($request->request->get('save_mode')== 'save_and_close') {
                    return $this->redirect($this->generateUrl('admin_empleador'));
                }
                return $this->redirect($this->generateUrl('admin_empleador_new'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Empleador entity.
    *
    * @param Empleador $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Empleador $entity)
    {
        $form = $this->createForm(new EmpleadorType(), $entity, array(
            'action' => $this->generateUrl('admin_empleador_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new Empleador entity.
     *
     * @Route("/new", name="admin_empleador_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Empleador();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Empleador entity.
     *
     * @Route("/{id}", name="admin_empleador_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Empleador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empleador entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Empleador entity.
     *
     * @Route("/{id}/edit", name="admin_empleador_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Empleador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empleador entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Empleador entity.
    *
    * @param Empleador $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Empleador $entity)
    {
        $form = $this->createForm(new EmpleadorType(), $entity, array(
            'action' => $this->generateUrl('admin_empleador_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        
        return $form;
    }
    /**
     * Edits an existing Empleador entity.
     *
     * @Route("/{id}/edit", name="admin_empleador_update")
     * @Method("PUT")
     * @Template("AppBundle:Empleador:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Empleador')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empleador entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('success',"El Empleador $entity se actualizó correctamente.");
            return $this->redirect($this->generateUrl('admin_empleador'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Empleador entity.
     *
     * @Route("/{id}", name="admin_empleador_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Empleador')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Empleador entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_empleador'));
    }

    /**
     * Creates a form to delete a Empleador entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_empleador_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'Delete',
                'attr'  => array(
                        'class' => 'btn btn-danger btn-sm'
                )
            ))
            ->getForm()
        ;
    }

}
