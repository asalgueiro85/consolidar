<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Modelo1007Type extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contrato','text', array(
                'label'=>'NUM_CONTRA ',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('prestamista','text', array(
                'label'=>'PRESTAMISTA ',
                'attr'=> array(
                    'class' =>'form-control')
            ))
//            ->add('pais', 'choice',array(
//                'label'=>'COD_PAIS',
//                'attr'=> array(
//                    'class' =>'form-control'),
//                'choices'=>array(
//                    ''=>'',
//                    'CA'=>'CA',
//                    'PA'=>'PA',
//                    'VG'=>'VG',
//                    'ES'=>'ES',
//                    'MX'=>'MX',
//                    'IT'=>'IT',
//                    'RU'=>'RU',
//                    'CR'=>'CR',
//                    'SV'=>'SV',
//                    'CL'=>'CL',
//                    'NZ'=>'NZ',
//                    'FR'=>'FR',
//                    'AN'=>'AN',
//                    'RO'=>'RO',
//                    'BE'=>'BE'
//                )
//            ))
//            ->add('moneda', 'choice',array(
//                'label'=>'SIG_MONEDA',
//                'attr'=> array(
//                    'class' =>'form-control'),
//                'choices'=>array(
//                    ''=>'',
//                    'CAD'=>'CAD',
//                    'USD'=>'USD',
//                    'EUR'=>'EUR',
//                    'PAB'=>'PAB',
//                    'GBP'=>'GBP',
//                )
//            ))
            ->add('pais', null, array(
                'label' => 'COD_PAIS',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => "COD_PAIS")
            ))

            ->add('moneda', null, array(
                'label' => 'SIG_MONEDA',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => "SIG_MONEDA")
            ))
            ->add('termino','text', array(
                'label'=>'TERMINO ',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('impNfrec','text', array(
                'label'=>'IMP_NFREC ',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('impTotpr','text', array(
                'label'=>'IMP_TOTPR ',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('impIntcmv','text', array(
                'label'=>'IMP_INTCMV ',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('princiVdo','text', array(
                'label'=>'PRINCI_VDO ',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('impIntcmn','text', array(
                'label'=>'IMP_INTCMN ',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('impIntpv','text', array(
                'label'=>'IMP_INTPV ',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('modelo')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Modelo1007'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_modelo1007';
    }
}
