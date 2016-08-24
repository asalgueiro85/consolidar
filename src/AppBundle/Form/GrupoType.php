<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GrupoType extends AbstractType
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
            ->add('logo','file', array('required'=>false))
            ->add('firma1','text', array(
                'label'=>'Firma',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('firma2','text', array(
                'label'=>'Firma',
                'attr'=> array(
                    'class' =>'form-control')
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Grupo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_grupo';
    }
}
