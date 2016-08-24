<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Empresa;
use AppBundle\Form\EmpresaType;

/**
 * Empresa controller.
 *
 * @Route("/empresa")
 */
class EmpresaController extends Controller
{

    /**
     * Lists all Empresa entities.
     *
     * @Route("/", name="empresa")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Empresa')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Empresa entity.
     *
     * @Route("/", name="empresa_create")
     * @Method("POST")
     * @Template("AppBundle:Empresa:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Empresa();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);


        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $grupo = $em->getRepository('AppBundle:Grupo')->findAll();
            $entity->setGrupo($grupo[0]);
            $entity->subirFoto();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('empresa', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Empresa entity.
     *
     * @param Empresa $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Empresa $entity)
    {
        $form = $this->createForm(new EmpresaType(), $entity, array(
            'action' => $this->generateUrl('empresa_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Empresa entity.
     *
     * @Route("/new", name="empresa_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Empresa();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Empresa entity.
     *
     * @Route("/{id}", name="empresa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Empresa entity.
     *
     * @Route("/{id}/edit", name="empresa_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresa entity.');
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
    * Creates a form to edit a Empresa entity.
    *
    * @param Empresa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Empresa $entity)
    {
        $form = $this->createForm(new EmpresaType(), $entity, array(
            'action' => $this->generateUrl('empresa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Empresa entity.
     *
     * @Route("/{id}", name="empresa_update")
     * @Method("PUT")
     * @Template("AppBundle:Empresa:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->subirFoto();
            $em->flush();

            return $this->redirect($this->generateUrl('empresa'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Empresa entity.
     *
     * @Route("/{id}/eliminar", name="empresa_delete")
     */
    public function deleteAction(Request $request, $id)
    {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Empresa')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Empresa entity.');
            }

            $em->remove($entity);
            $em->flush();


        return $this->redirect($this->generateUrl('empresa'));


    }

    /**
     * Creates a form to delete a Empresa entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('empresa_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
