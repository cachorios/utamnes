<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpleadorType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('razon')
            ->add('cuit')
            ->add('direccion')
            ->add('telefono')
            ->add('email','email')
            ->add('localidad')
            ->add('fecha_actualizacion',null, array(
                    'format' => 'dd-MM-yyyy hh:mm:ss',
                    'html5' => true,
                    'widget' => 'single_text',
                    'attr' => array('readonly' => true)))
//            ->add('usuario')
        ;
    }
    

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Empleador'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_empleador';
    }
}
