<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConceptoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('descripcion')
            ->add('descripcion_corta')
            ->add('obligatorio')
            ->add('activo')
            ->add('formulagit p')
            ->add('fecha_actualizacion',null, array(
                    'format' => 'dd-MM-yyyy hh:mm:ss',
                    'html5' => true,
                    'widget' => 'single_text',
                    'attr' => array('readonly' => true)))
//            ->add('usuario')
//            ->add('trabajador')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Concepto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_concepto';
    }
}
