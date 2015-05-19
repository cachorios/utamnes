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
            ->add('obligatorio',"checkbox",array("required" => false))
            ->add('activo',"checkbox",array("required" => false))
            ->add('formula',"textarea",array("attr" =>array("rows" =>8 )))


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
