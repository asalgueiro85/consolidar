<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Modelo101BType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('extNoVen','text', array(
                'label'=>'EXT_No_VEN',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('ext060','text', array(
                'label'=>'EXT_0_60',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('ext6190','text', array(
                'label'=>'EXT_61_90',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('extMas90','text', array(
                'label'=>'EXT_MAS90',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('extTotVe','text', array(
                'label'=>'EXT_TOT_VE',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('extEfecto','text', array(
                'label'=>'EXT_EFECTO',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('litJudE','text', array(
                'label'=>'LIT_JUD_E',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('litProtE','text', array(
                'label'=>'LIT_PROT_E',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('sentPentE','text', array(
                'label'=>'SENT_PEN_E',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('tVtCrEx','text', array(
                'label'=>'T_VT_CR_EX',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('contravalor','text', array(
                'label'=>'Contravalor ',
                'attr'=> array(
                    'class' =>'form-control')
            ))
//            ->add('modelo')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Modelo101B'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_modelo101b';
    }
}
