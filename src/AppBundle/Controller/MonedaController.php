<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Moneda;
use AppBundle\Form\MonedaType;

/**
 * Moneda controller.
 *
 * @Route("/moneda")
 */
class MonedaController extends Controller
{

    /**
     * Lists all Moneda entities.
     *
     * @Route("/", name="moneda")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Moneda')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Moneda entity.
     *
     * @Route("/", name="moneda_create")
     * @Method("POST")
     * @Template("AppBundle:Moneda:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Moneda();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('moneda'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Moneda entity.
     *
     * @param Moneda $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Moneda $entity)
    {
        $form = $this->createForm(new MonedaType(), $entity, array(
            'action' => $this->generateUrl('moneda_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new Moneda entity.
     *
     * @Route("/new", name="moneda_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Moneda();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Moneda entity.
     *
     * @Route("/{id}", name="moneda_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Moneda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Moneda entity.');
        }


        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Moneda entity.
     *
     * @Route("/{id}/edit", name="moneda_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Moneda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Moneda entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Moneda entity.
    *
    * @param Moneda $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Moneda $entity)
    {
        $form = $this->createForm(new MonedaType(), $entity, array(
            'action' => $this->generateUrl('moneda_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }
    /**
     * Edits an existing Moneda entity.
     *
     * @Route("/{id}", name="moneda_update")
     * @Method("PUT")
     * @Template("AppBundle:Moneda:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Moneda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Moneda entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('moneda'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a Moneda entity.
     *
     * @Route("/{id}/eliminar", name="moneda_delete")
     */
    public function deleteAction($id)
    {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Moneda')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Moneda entity.');
            }

            $em->remove($entity);
            $em->flush();


        return $this->redirect($this->generateUrl('moneda'));
    }

    /**
     * Creates a form to delete a Moneda entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('moneda_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
