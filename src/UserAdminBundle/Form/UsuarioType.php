<?php

namespace  UserAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add("username",null, array('label' => "Usuario"))
            ->add("nombre")
            ->add("telefono")
            ->add("email")
//            ->add("foto")
//            ->add("password","password")
//            ->add("password","repeated", array(
//                    'type' => "password",
//                    'invalid_message' => "Las claves deben ser identicas",
//                    'required' => false,
//                    'first_options' => array('label' => 'Clave'),
//                    'second_options' => array('label' => 'Repetir Clave'),
//                ))

            ;

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RBSoft\UsuarioBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rbsoft_usuariobundle_usuario';
    }
}
