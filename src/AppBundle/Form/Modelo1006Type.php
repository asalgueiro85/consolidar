<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Modelo1006Type extends AbstractType
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
            ->add('termino','text', array(
                'label'=>'TERMINO ',
                'attr'=> array(
                    'class' =>'form-control')
            ))
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


            ->add('impPrincipal','text', array(
                'label'=>'IMP_PRINCI',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('aPago','text', array(
                'label'=>'A_PAGO',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('princiVdo','text', array(
                'label'=>'PRINCI_VDO ',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('impIntcov','text', array(
                'label'=>'IMP_INTCOV',
                'attr'=> array(
                    'class' =>'form-control')
            ))
            ->add('impIntmor','text', array(
                'label'=>'IMP_INTMOR',
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
            'data_class' => 'AppBundle\Entity\Modelo1006'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_modelo1006';
    }
}
