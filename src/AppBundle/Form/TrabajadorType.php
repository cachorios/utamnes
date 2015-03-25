<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrabajadorType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cuil')
            ->add('nombre')
            ->add('legajo')
            ->add('email','email', array('required' => false))
            ->add('telefono')
            ->add('direccion')
            ->add('localidad')
            ->add('sexo','choice', array(
                    'choices' => array(
                        'M' => 'Masculino',
                        'F' => 'Femenino'
                    )
                ))
            ->add('estado_civil', 'choice', array(
                    'choices' => array(
                        'S' => 'Soltero',
                        'C' => 'Casado',
                        'D' => 'Divorciado',
                        'V' => 'Viudo'
                    )
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Trabajador'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_trabajador';
    }
}
