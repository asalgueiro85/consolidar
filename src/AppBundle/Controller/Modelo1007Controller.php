<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Modelo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Modelo1007;
use AppBundle\Form\Modelo1007Type;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Modelo1007 controller.
 *
 * @Route("/modelo1007")
 */
class Modelo1007Controller extends Controller
{

    /**
     * Lists all Modelo1007 entities.
     *
     * @Route("/", name="modelo1007")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = null;
        if($this->getUser()->getGrupo())
            $entities = $em->getRepository('AppBundle:Modelo')->findByTipo(1007);
        else
        $entities = $em->getRepository('AppBundle:Modelo')->modelos(1007, $this->getUser()->getEmpresa()->getId());

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Modelo1007 entity.
     *
     * @Route("/", name="modelo1007_create")
     * @Method("POST")
     * @Template("AppBundle:Modelo1007:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Modelo1007();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $modelo = $em->getRepository('AppBundle:Modelo')->modeloAbierto(1007, $this->getUser()->getEmpresa()->getId());
            if(!$modelo) {
                $modelo = new Modelo();
                $modelo->setEstado(1);
                $modelo->setFecha(new \DateTime());
                $modelo->setTipo(1007);
                $modelo->setUsuario($this->getUser());
                $entity->setModelo($modelo);
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('modelo1007'));
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
     * Creates a form to create a Modelo1007 entity.
     *
     * @param Modelo1007 $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Modelo1007 $entity)
    {
        $form = $this->createForm(new Modelo1007Type(), $entity, array(
            'action' => $this->generateUrl('modelo1007_create'),
            'method' => 'POST',
        ));


        return $form;
    }

    /**
     * Displays a form to create a new Modelo1007 entity.
     *
     * @Route("/new", name="modelo1007_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Modelo1007();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Modelo1007 entity.
     *
     * @Route("/{id}", name="modelo1007_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $modelo = $em->getRepository('AppBundle:Modelo')->find($id);

        $entities = $em->getRepository('AppBundle:Modelo1007')->findByModelo($modelo);

        if (!$entities) {
            throw $this->createNotFoundException('Unable to find Modelo1007 entity.');
        }
        return array(
            'entities'      => $entities,
        );
    }

    /**
     * Displays a form to edit an existing Modelo1007 entity.
     *
     * @Route("/{id}/edit", name="modelo1007_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $modelo = $em->getRepository('AppBundle:Modelo')->find($id);
        $entities = $em->getRepository('AppBundle:Modelo1007')->findByModelo($modelo);
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
    * Creates a form to edit a Modelo1007 entity.
    *
    * @param Modelo1007 $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Modelo1007 $entity)
    {
        $form = $this->createForm(new Modelo1007Type(), $entity, array(
            'action' => $this->generateUrl('modelo1007_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));


        return $form;
    }
    /**
     * Edits an existing Modelo1007 entity.
     *
     * @Route("/{id}", name="modelo1007_update")
     * @Method("PUT")
     * @Template("AppBundle:Modelo1007:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Modelo1007')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modelo1007 entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('modelo1007_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a Modelo1007 entity.
     *
     * @Route("/{id}/eliminar", name="modelo1007_delete")
     */
    public function deleteAction( $id)
    {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Modelo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Modelo1007 entity.');
            }

            $em->remove($entity);
            $em->flush();


        return $this->redirect($this->generateUrl('modelo1007'));
    }

    /**
     * Creates a form to delete a Modelo1007 entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modelo1007_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Confirmar a Modelo1007 entity.
     *
     * @Route("/confirmar/{id}", name="modelo1007_confirmar")
     */
    public function confirmarAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Modelo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modelo1007 entity.');
        }
        $entity->setEstado(2);
        $em->persist($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('modelo1007'));
    }

    /**
     * Confirmar a Modelo1007 entity.
     *
     * @Route("/revertir/{id}", name="modelo1007_revertir")
     */
    public function revertirAction($id)
    {


        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:Modelo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modelo1007 entity.');
        }
        $entity->setEstado(1);
        $em->persist($entity);
        $em->flush();


        return $this->redirect($this->generateUrl('modelo1007'));
    }

    /**
     * detalles modelo1007
     * @Route("/modelo1007_addrow", name="modelo1007_addrow")
     * @Method("POST")
     * @Template()
     */
    public function modelo1007_addrowAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $moneda = $em->getRepository('AppBundle:Moneda')->find($request->get('addmoneda'));
        $pais = $em->getRepository('AppBundle:Pais')->find($request->get('addpais'));
        if(!$request->get('addid')) {
            $entity = new Modelo1007();
            $modelo = $em->getRepository('AppBundle:Modelo')->find($request->get('id'));


            $entity->setContrato($request->get('addcontrato'));
            $entity->setPrestamista($request->get('addprestamista'));
            $entity->setMoneda($moneda);
            $entity->setPais($pais);
            $entity->setTermino($request->get('addtermino'));

            $entity->setImpNfrec($request->get('addimpnfrec'));
            $entity->setImpTotpr($request->get('addimptotpr'));
            $entity->setImpIntcmv($request->get('addintcmv'));

            $entity->setPrinciVdo($request->get('addprincivdo'));
            $entity->setImpIntcmn($request->get('addimpintcmn'));
            $entity->setImpIntpv($request->get('addimpintpv'));


            $entity->setModelo($modelo);
            $em->persist($entity);
            $em->flush();
            $data = array();

            $data[0]['result'] = 1;
            $data[0]['id'] = $entity->getId();
            $data[0]['addcontrato'] = $request->get('addcontrato');
            $data[0]['addprestamista'] = $request->get('addprestamista');
            $data[0]['addmoneda'] = $moneda->getAbrev();
            $data[0]['addpais'] =  $pais->getAbrev();
            $data[0]['addmonedaid'] = $request->get('addmoneda');
            $data[0]['addpaisid'] =  $request->get('addpais');
            $data[0]['addtermino'] = $request->get('addtermino');

            $data[0]['addimpnfrec'] = $request->get('addimpnfrec');
            $data[0]['addimptotpr'] = $request->get('addimptotpr');
            $data[0]['addintcmv'] = $request->get('addintcmv');

            $data[0]['addprincivdo'] = $request->get('addprincivdo');
            $data[0]['addimpintcmn'] = $request->get('addimpintcmn');
            $data[0]['addimpintpv'] = $request->get('addimpintpv');
        }else
        {
            $modelo = $em->getRepository('AppBundle:Modelo1007')->find($request->get('addid'));
            $modelo->setContrato($request->get('addcontrato'));
            $modelo->setPrestamista($request->get('addprestamista'));

            $modelo->setMoneda($moneda);
            $modelo->setPais($pais);
            $modelo->setTermino($request->get('addtermino'));

            $modelo->setImpNfrec($request->get('addimpnfrec'));
            $modelo->setImpTotpr($request->get('addimptotpr'));
            $modelo->setImpIntcmv($request->get('addintcmv'));

            $modelo->setPrinciVdo($request->get('addprincivdo'));
            $modelo->setImpIntcmn($request->get('addimpintcmn'));
            $modelo->setImpIntpv($request->get('addimpintpv'));

            $em->persist($modelo);
            $em->flush();
            $data[0]['result'] = -1;

            $data[0]['addcontrato'] = $request->get('addcontrato');
            $data[0]['addprestamista'] = $request->get('addprestamista');
            $data[0]['addmoneda'] = $moneda->getAbrev();
            $data[0]['addpais'] =  $pais->getAbrev();
            $data[0]['addtermino'] = $request->get('addtermino');
            $data[0]['addmonedaid'] = $request->get('addmoneda');
            $data[0]['addpaisid'] =  $request->get('addpais');

            $data[0]['addimpnfrec'] = $request->get('addimpnfrec');
            $data[0]['addimptotpr'] = $request->get('addimptotpr');
            $data[0]['addintcmv'] = $request->get('addintcmv');

            $data[0]['addprincivdo'] = $request->get('addprincivdo');
            $data[0]['addimpintcmn'] = $request->get('addimpintcmn');
            $data[0]['addimpintpv'] = $request->get('addimpintpv');

        }
        return new JsonResponse($data);
    }

}
