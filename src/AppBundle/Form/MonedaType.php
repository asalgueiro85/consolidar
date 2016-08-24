<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MonedaType extends AbstractType
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
            ->add('abrev','text', array(
                'label'=>'Abreviatura',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('descripcion','textarea', array(
                'label'=>'Desripción',
                'required'=> false,
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
            'data_class' => 'AppBundle\Entity\Moneda'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_moneda';
    }
}
