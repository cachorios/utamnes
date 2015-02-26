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
            ->add('estado_civil')
            ->add('localidad')
            ->add('sexo')
            ->add('email')
            ->add('telefono')
            ->add('direccion')
            ->add('nombre')
            ->add('cuil')
            ->add('legajo')
            ->add('fecha_actualizacion')
            ->add('usuario')
            ->add('empleador')
            ->add('concepto')
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
