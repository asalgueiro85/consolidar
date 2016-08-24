<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Modelo101B;
use AppBundle\Form\Modelo101BType;

/**
 * Modelo101B controller.
 *
 * @Route("/modelo101b")
 */
class Modelo101BController extends Controller
{

    /**
     * Lists all Modelo101B entities.
     *
     * @Route("/", name="modelo101b")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = null;
        if($this->getUser()->getGrupo())
            $entities = $em->getRepository('AppBundle:Modelo101B')->findAll();
        else
        $entities = $em->getRepository('AppBundle:Modelo101B')->modelos($this->getUser()->getEmpresa()->getId());
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Modelo101B entity.
     *
     * @Route("/", name="modelo101b_create")
     * @Method("POST")
     * @Template("AppBundle:Modelo101B:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Modelo101B();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $modelo = $em->getRepository('AppBundle:Modelo101b')->modeloAbierto($this->getUser()->getEmpresa()->getId());
            if(!$modelo){

            $em = $this->getDoctrine()->getManager();
            $entity->setEstado(1);
            $entity->setUsuario($this->getUser());
            $entity->setFecha(new \DateTime());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('modelo101b'));
            }
            else{
                throw $this->createNotFoundException('Ya existe un modelo abierto confirma antes de adicionar otro');
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Modelo101B entity.
     *
     * @param Modelo101B $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Modelo101B $entity)
    {
        $form = $this->createForm(new Modelo101BType(), $entity, array(
            'action' => $this->generateUrl('modelo101b_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Modelo101B entity.
     *
     * @Route("/new", name="modelo101b_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Modelo101B();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Modelo101B entity.
     *
     * @Route("/{id}", name="modelo101b_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Modelo101B')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modelo101B entity.');
        }


        return array(
            'entity'      => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Modelo101B entity.
     *
     * @Route("/{id}/edit", name="modelo101b_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Modelo101B')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modelo101B entity.');
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
    * Creates a form to edit a Modelo101B entity.
    *
    * @param Modelo101B $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Modelo101B $entity)
    {
        $form = $this->createForm(new Modelo101BType(), $entity, array(
            'action' => $this->generateUrl('modelo101b_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Modelo101B entity.
     *
     * @Route("/{id}", name="modelo101b_update")
     * @Method("PUT")
     * @Template("AppBundle:Modelo101B:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Modelo101B')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modelo101B entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('modelo101b'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Modelo101B entity.
     *
     * @Route("/{id}", name="modelo101b_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {


            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Modelo101B')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Modelo101B entity.');
            }

            $em->remove($entity);
            $em->flush();


        return $this->redirect($this->generateUrl('modelo101b'));
    }

    /**
     * Deletes a Modelo101B entity.
     *
     * @Route("/{id}/confirmar", name="modelo101b_confirmar")
     */
    public function confirmarAction(Request $request, $id)
    {


        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Modelo101B')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modelo101B entity.');
        }
        $entity->setEstado(2);
        $em->persist($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('modelo101b'));
    }

    /**
     * Creates a form to delete a Modelo101B entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modelo101b_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Confirmar a Modelo1006 entity.
     *
     * @Route("/revertir/{id}", name="modelo101b_revertir")
     */
    public function revertirAction($id)
    {


        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Modelo101B')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modelo1006 entity.');
        }
        $entity->setEstado(1);
        $em->persist($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('modelo101b'));
    }
}
