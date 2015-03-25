<?php

namespace AppBundle\Form;

use AppBundle\Entity\Trabajador;
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
            ->add('nombre',"text", array("label" =>"Apellido y Nombre"))
            ->add('legajo')
            ->add('email','email', array('required' => false))
            ->add('telefono')
            ->add('direccion')
            ->add('localidad')
            ->add('sexo','choice', array(
                    'choices' => Trabajador::$SEXO
                ))
            ->add('estado_civil', 'choice', array(
                    'choices' => Trabajador::$ESTDO_CIVIL
                ))
            ->add('fecha_ingreso','date',
                array(
                    "input" => "datetime",
                    "widget" => "single_text",
                    'format' => 'dd/MM/yyyy',

                ))
            ->add('fecha_baja','date',
                array(
                    "input" => "datetime",
                    "widget" => "single_text",
                    'format' => 'dd/MM/yyyy',
                    "attr" => array("class" => "datepicker"),
                    "required" => false
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
