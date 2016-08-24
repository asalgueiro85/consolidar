<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Modelo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Modelo1006;
use AppBundle\Form\Modelo1006Type;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Modelo1006 controller.
 *
 * @Route("/modelo1006")
 */
class Modelo1006Controller extends Controller
{

    /**
     * Lists all Modelo1006 entities.
     *
     * @Route("/", name="modelo1006")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = null;
        if($this->getUser()->getGrupo())
            $entities = $em->getRepository('AppBundle:Modelo')->findByTipo(1006);
        else
        $entities = $em->getRepository('AppBundle:Modelo')->modelos(1006, $this->getUser()->getEmpresa()->getId());


        return array(
            'entities' => $entities,

        );
    }
    /**
     * Creates a new Modelo1006 entity.
     *
     * @Route("/", name="modelo1006_create")
     * @Method("POST")
     * @Template("AppBundle:Modelo1006:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Modelo1006();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $modelo = $em->getRepository('AppBundle:Modelo')->modeloAbierto(1006, $this->getUser()->getEmpresa()->getId());
            if(!$modelo) {
                $modelo = new Modelo();
                $modelo->setEstado(1);
                $modelo->setFecha(new \DateTime());
                $modelo->setTipo(1006);
                $modelo->setUsuario($this->getUser());
                $entity->setModelo($modelo);
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('modelo1006'));
            }
            else{
                throw $this->createNotFoundException('Ya existe un modelo confirma antes de adicionar otro');
            }



        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }


    /**
     * razas por especies.
     *
     * @Route("/modelo1006_addrow", name="modelo1006_addrow")
     * @Method("POST")
     * @Template()
     */
    public function modelo1006_addrowAction(Request $request)
    {
        $id = $request->get('id');
        //dump($request);die();
        $em = $this->getDoctrine()->getManager();
        $moneda = $em->getRepository('AppBundle:Moneda')->find($request->get('addmoneda'));
        $pais = $em->getRepository('AppBundle:Pais')->find($request->get('addpais'));
        if(!$request->get('addid')) {

            $entity = new Modelo1006();
            $modelo = $em->getRepository('AppBundle:Modelo')->find($request->get('id'));
            $entity->setAPago($request->get('addaPago'));
            $entity->setContrato($request->get('addcontrato'));
            $entity->setImpIntcov($request->get('addimpIntcov'));
            $entity->setImpIntmor($request->get('addimpIntmor'));
            $entity->setImpPrincipal($request->get('addimpPrincipal'));
            $entity->setMoneda($moneda);
            $entity->setPais($pais);
            $entity->setPrestamista($request->get('addprestamista'));
            $entity->setPrinciVdo($request->get('addprinciVdo'));
            $entity->setTermino($request->get('addtermino'));
            $entity->setModelo($modelo);
            $em->persist($entity);
            $em->flush();
            $data = array();
            $data[0]['result'] = 1;
            $data[0]['id'] = $entity->getId();
            $data[0]['addaPago'] = $request->get('addaPago');
            $data[0]['addcontrato'] = $request->get('addcontrato');
            $data[0]['addimpIntcov'] = $request->get('addimpIntcov');
            $data[0]['addimpIntmor'] = $request->get('addimpIntmor');
            $data[0]['addimpPrincipal'] = $request->get('addimpPrincipal');
            $data[0]['addmoneda'] = $moneda->getAbrev();
            $data[0]['addpais'] =  $pais->getAbrev();
            $data[0]['addmonedaid'] = $request->get('addmoneda');
            $data[0]['addpaisid'] =  $request->get('addpais');
            $data[0]['addprestamista'] = $request->get('addprestamista');
            $data[0]['addprinciVdo'] = $request->get('addprinciVdo');
            $data[0]['addtermino'] = $request->get('addtermino');
        }else
        {
            $modelo = $em->getRepository('AppBundle:Modelo1006')->find($request->get('addid'));
            $modelo->setAPago($request->get('addaPago'));
            $modelo->setContrato($request->get('addcontrato'));
            $modelo->setImpIntcov($request->get('addimpIntcov'));
            $modelo->setImpIntmor($request->get('addimpIntmor'));
            $modelo->setImpPrincipal($request->get('addimpPrincipal'));

            $modelo->setMoneda($moneda);
            $modelo->setPais($pais);
            $modelo->setPrestamista($request->get('addprestamista'));
            $modelo->setPrinciVdo($request->get('addprinciVdo'));
            $modelo->setTermino($request->get('addtermino'));
            $em->persist($modelo);
            $em->flush();
            $data[0]['result'] = -1;
            $data[0]['addaPago'] = $request->get('addaPago');
            $data[0]['addcontrato'] = $request->get('addcontrato');
            $data[0]['addimpIntcov'] = $request->get('addimpIntcov');
            $data[0]['addimpIntmor'] = $request->get('addimpIntmor');
            $data[0]['addimpPrincipal'] = $request->get('addimpPrincipal');
            $data[0]['addmoneda'] = $moneda->getAbrev();
            $data[0]['addmonedaid'] = $request->get('addmoneda');
            $data[0]['addpais'] =  $pais->getAbrev();
            $data[0]['addpaisid'] =  $request->get('addpais');
            $data[0]['addprestamista'] = $request->get('addprestamista');
            $data[0]['addprinciVdo'] = $request->get('addprinciVdo');
            $data[0]['addtermino'] = $request->get('addtermino');

        }
        return new JsonResponse($data);
    }



    /**
     * Confirmar a Modelo1006 entity.
     *
     * @Route("/confirmar/{id}", name="modelo1006_confirmar")
     */
    public function confirmarAction($id)
    {


        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Modelo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modelo1006 entity.');
        }
        $entity->setEstado(2);
        $em->persist($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('modelo1006'));
    }

    /**
     * Confirmar a Modelo1006 entity.
     *
     * @Route("/revertir/{id}", name="modelo1006_revertir")
     */
    public function revertirAction($id)
    {


        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Modelo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modelo1006 entity.');
        }
        $entity->setEstado(1);
        $em->persist($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('modelo1006'));
    }
    /**
     * Creates a form to create a Modelo1006 entity.
     *
     * @param Modelo1006 $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Modelo1006 $entity)
    {
        $form = $this->createForm(new Modelo1006Type(), $entity, array(
            'action' => $this->generateUrl('modelo1006_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new Modelo1006 entity.
     *
     * @Route("/new", name="modelo1006_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Modelo1006();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Modelo1006 entity.
     *
     * @Route("/{id}", name="modelo1006_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $modelo = $em->getRepository('AppBundle:Modelo')->find($id);

        $entities = $em->getRepository('AppBundle:Modelo1006')->findByModelo($modelo);

        if (!$entities) {
            throw $this->createNotFoundException('Unable to find Modelo1006 entity.');
        }


        return array(
            'entities'      => $entities,
        );
    }

    /**
     * Displays a form to edit an existing Modelo1006 entity.
     *
     * @Route("/{id}/edit", name="modelo1006_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $modelo = $em->getRepository('AppBundle:Modelo')->find($id);
        $entities = $em->getRepository('AppBundle:Modelo1006')->findByModelo($modelo);
        $monedas = $em->getRepository('AppBundle:Moneda')->findAll();
        $pais = $em->getRepository('AppBundle:Pais')->findAll();

        return array(
            'entities' => $entities,
            'entity' => $id,
            'monedas' => $monedas,
            'pais' => $pais,
        );
    }

    /**
    * Creates a form to edit a Modelo1006 entity.
    *
    * @param Modelo1006 $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Modelo1006 $entity)
    {
        $form = $this->createForm(new Modelo1006Type(), $entity, array(
            'action' => $this->generateUrl('modelo1006_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }
    /**
     * Edits an existing Modelo1006 entity.
     *
     * @Route("/{id}", name="modelo1006_update")
     * @Method("PUT")
     * @Template("AppBundle:Modelo1006:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Modelo1006')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modelo1006 entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('modelo1006'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a Modelo1006 entity.
     *
     * @Route("/{id}/eliminar", name="modelo1006_delete")
     */
    public function deleteAction($id)
    {
            $em = $this->getDoctrine()->getManager();
        //dump($id);die;
            $entity = $em->getRepository('AppBundle:Modelo')->find($id);
//        dump($entity);die;
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Modelo1006 entity.');
            }

            $em->remove($entity);
            $em->flush();


        return $this->redirect($this->generateUrl('modelo1006'));
    }

    /**
     * Creates a form to delete a Modelo1006 entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modelo1006_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
