<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Knp\Component\Pager\Paginator;

use AppBundle\Entity\Vencimiento;
use AppBundle\Form\VencimientoType;
use AppBundle\Form\VencimientoFilterType;




/**
 * Vencimiento controller.
 *
 * @Route("/admin/vencimiento")
 */
class VencimientoController extends Controller
{

    /**
     * Lists all Vencimiento entities.
     *
     * @Route("/", name="admin_vencimiento")
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
        $filterForm = $this->createForm(new VencimientoFilterType());

        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('AppBundle:Vencimiento')->createQueryBuilder("q");

        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('submit-filter') == 'reset') {
            $session->remove('VencimientoControllerFilter');
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
                $session->set('VencimientoControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('VencimientoControllerFilter')) {
                $filterData = $session->get('VencimientoControllerFilter');
                $filterForm = $this->createForm(new VencimientoFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
           }
        }
        return array($filterForm, $queryBuilder);
    }

    /**
     * Creates a new Vencimiento entity.
     *
     * @Route("/new", name="admin_vencimiento_create")
     * @Method("POST")
     * @Template("AppBundle:Vencimiento:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Vencimiento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success',"El Vencimiento $entity se creó correctamente.");
            if ($request->request->get('save_mode')== 'save_and_close') {
                    return $this->redirect($this->generateUrl('admin_vencimiento'));
                }
                return $this->redirect($this->generateUrl('admin_vencimiento_new'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Vencimiento entity.
    *
    * @param Vencimiento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Vencimiento $entity)
    {
        $form = $this->createForm(new VencimientoType(), $entity, array(
            'action' => $this->generateUrl('admin_vencimiento_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new Vencimiento entity.
     *
     * @Route("/new", name="admin_vencimiento_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Vencimiento();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Vencimiento entity.
     *
     * @Route("/{id}", name="admin_vencimiento_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Vencimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vencimiento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Vencimiento entity.
     *
     * @Route("/{id}/edit", name="admin_vencimiento_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Vencimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vencimiento entity.');
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
    * Creates a form to edit a Vencimiento entity.
    *
    * @param Vencimiento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Vencimiento $entity)
    {
        $form = $this->createForm(new VencimientoType(), $entity, array(
            'action' => $this->generateUrl('admin_vencimiento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        
        return $form;
    }
    /**
     * Edits an existing Vencimiento entity.
     *
     * @Route("/{id}/edit", name="admin_vencimiento_update")
     * @Method("PUT")
     * @Template("AppBundle:Vencimiento:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Vencimiento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vencimiento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $this->get('session')->getFlashBag()->add('success',"El Vencimiento $entity se actualizó correctamente.");
            return $this->redirect($this->generateUrl('admin_vencimiento'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Vencimiento entity.
     *
     * @Route("/{id}", name="admin_vencimiento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Vencimiento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vencimiento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_vencimiento'));
    }

    /**
     * Creates a form to delete a Vencimiento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_vencimiento_delete', array('id' => $id)))
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
