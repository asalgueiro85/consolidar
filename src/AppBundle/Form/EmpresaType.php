<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpresaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre','text', array(
                'label'=>'Nombre',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('codigo','text', array(
                'label'=>'Código',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('desccripcion','textarea', array(
                'label'=>'Desripción',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('direccion','text', array(
                'label'=>'Dirección',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('telefono','text', array(
                'label'=>'Teléfono',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('logo','file', array('required'=>false))
            ->add('estado','checkbox', array(
                'required' => false,
                'label'=>'Activo',
                'attr' => array(
                    'class' => 'flat-red'
                )
            ))
            ->add('firma1','text', array(
                'label'=>'Firma1',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('firma2','text', array(
                'label'=>'Firma2',
                'attr'=> array(
                    'class' =>'form-control')
            ))
//            ->add('grupo', 'choice', array(
//                'label' => 'Grupo',
//                'attr' => array(
//                    'class' => 'form-control',
//                    'placeholder' => "Grupo")
//            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Empresa'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_empresa';
    }
}
