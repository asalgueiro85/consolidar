<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
    private $rol;

    function __construct($rol)
    {
        $this->rol = $rol;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        switch ($this->rol) {
            case '':
                $builder
                    ->add('name', 'text', array(
                        'label' => 'Nombre',
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => "Nombre")
                    ))
                    ->add('role', 'choice', array('label'=>'Rol',
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => "Rol"),
                        'choices'   => array(
                            'ROLE_CLIENTE'   => 'Cliente',
                            'ROLE_ADMIN'     => 'Administrador',
                            'ROLE_SUPER'     => 'Super Administrador',
                        )
                    ))
                    ->add('password', 'repeated', array(
                        'label' => 'Contraseña',
                        'type' => 'password',
                        'required' => true,
                        'first_options'  => array('label' => 'Contraseña'),
                        'second_options' => array('label' => 'Repita la  Contraseña'),
                        'options' => array(
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => "Contraseña")
                    )))
                    ->add('usuario', 'text', array(
                        'label' => 'Usuario',
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => "Usuario")
                    ))
                    ->add('grupo','checkbox', array(
                        'required' => false,
                        'label' => 'Grupo Empresarial',
                        'attr' => array(
                            'class' => 'flat-red'
                        )
                    ))
                    ->add('empresa', null, array(
                'label' => 'Empresa',
                'attr' => array(
                    'class' => 'form-control',
                    'placeholder' => "Empresa")
            ))
                    ->add('foto', 'file', array(
                        'required' => false,
                        'invalid_message' => 'No se admite imágenes mayores a 1MB',
                    ));
                break;

            default:
                $builder
                    ->add('name', 'text', array(
                        'label' => 'Nombre',
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => "Nombre")
                    ))
                    ->add('grupo','checkbox', array(
                        'required' => false,
                        'label' => 'Grupo Empresarial',
                        'attr' => array(
                            'class' => 'flat-red'
                        )
                    ))
//                    ->add('role', 'choice', array('label'=>'Rol',
//                        'choices'   => array(
//                            'ROLE_CLIENTE'   => 'Cliente',
//                            'ROLE_ADMIN'     => 'Administrador',
//                        )
//                    ))
//                    ->add('password', 'repeated', array(
//                        'label' => 'Contraseña',
//                        'type' => 'password',
//                        'required' => true,
//                        'first_options'  => array('label' => 'Contraseña'),
//                        'second_options' => array('label' => 'Repita la  Contraseña'),
//                        'options' => array(
//                            'attr' => array(
//                                'class' => 'form-control',
//                            )
//                        )))
                    ->add('usuario', 'text', array(
                        'label' => 'Usuario',
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => "Usuario")
                    ))
                    ->add('empresa', null, array(
                        'label' => 'Empresa',
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => "Empresa")
                    ))
                    ->add('role', 'choice', array('label'=>'Rol',
                        'attr' => array(
                            'class' => 'form-control',
                            'placeholder' => "Rol"),
                        'choices'   => array(
                            'ROLE_CLIENTE'   => 'Cliente',
                            'ROLE_ADMIN'     => 'Administrador',
                            'ROLE_SUPER'     => 'Super Administrador',
                        )
                    ))
                    ->add('foto', 'file', array(
                        'required' => false,
                        'invalid_message' => 'No se admite imágenes mayores a 1MB',
                    ));
                break;
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_usuario';
    }
}
