<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VencimientoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('anio')
            ->add('mes')
            ->add(
                'vencimiento',
                'date',
                array(
                    "input" => "datetime",
                    "widget" => "single_text",
                    'format' => 'dd/MM/yyyy',
                    "attr" => array("class" => "datepicker")
                )
            )
            ->add(
                'prorroga',
                'date',
                array(
                    "input" => "datetime",
                    "widget" => "single_text",
                    'format' => 'dd/MM/yyyy',
                    "attr" => array("class" => "datepicker"),
                    "required" => false
                )
            );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AppBundle\Entity\Vencimiento'
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_vencimiento';
    }
}
