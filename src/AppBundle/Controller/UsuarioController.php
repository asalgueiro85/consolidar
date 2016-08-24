<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use Symfony\Component\Security\Core\SecurityContext;


/**
 * Usuario controller.
 *
 * @Route("/usuario")
 */
class UsuarioController extends Controller
{

    /**
     * Lists all Usuario entities.
     *
     * @Route("/", name="usuario")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Usuario')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Usuario entity.
     *
     * @Route("/", name="usuario_create")
     * @Method("POST")
     * @Template("AppBundle:Usuario:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Usuario();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $factory = $this->get('security.encoder_factory');
            $salt = $entity->getSalt();//md5(time());
            $encoder = $factory->getEncoder($entity);
            $password = $encoder->encodePassword($entity->getPassword(),$salt);
            $entity->setPassword($password);
            $entity->setSalt($salt);
            $entity->subirFoto();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('usuario'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Usuario entity.
     *
     * @param Usuario $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Usuario $entity)
    {
        $form = $this->createForm(new UsuarioType($entity->getRole()[0]), $entity, array(
            'action' => $this->generateUrl('usuario_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Usuario entity.
     *
     * @Route("/new", name="usuario_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Usuario();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Usuario entity.
     *
     * @Route("/{id}", name="usuario_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Usuario')->findById($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to fisnd Usuario entity.');
        }
        return array(
            'entity'  => $entity,
        );
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     * @Route("/{id}/edit", name="usuario_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }
//        dump($entity);die;

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Usuario entity.
    *
    * @param Usuario $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Usuario $entity)
    {
        $form = $this->createForm(new UsuarioType($entity->getRole()[0]), $entity, array(
            'action' => $this->generateUrl('usuario_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Usuario entity.
     *
     * @Route("/{id}", name="usuario_update")
     * @Method("PUT")
     * @Template("AppBundle:Usuario:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
//            $factory = $this->get('security.encoder_factory');
//            $encoder = $factory->getEncoder($entity);
//            $password = $encoder->encodePassword($entity->getPassword(),$entity->getSalt());
//            $entity->setPassword($password);
            $entity->subirFoto();
            $em->flush();

            return $this->redirect($this->generateUrl('usuario'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a Usuario entity.
     *
     * @Route("/{id}/delete", name="usuario_delete")
     */
    public function deleteAction(Request $request, $id)
    {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Usuario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Usuario entity.');
            }

            $em->remove($entity);
            $em->flush();


        return $this->redirect($this->generateUrl('usuario'));
    }


}
