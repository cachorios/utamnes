<?php

namespace AppBundle\Form;

use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;

class ConceptoFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('id', 'filter_number_range')
            ->add('numero', 'filter_number_range')
            ->add('descripcion', 'filter_text', array('condition_pattern' => FilterOperands::STRING_BOTH))
            ->add('descripcion_corta', 'filter_text', array('condition_pattern' => FilterOperands::STRING_BOTH))
//            ->add('obligatorio', 'filter_choice')
//            ->add('activo', 'filter_choice')
//            ->add('fecha_actualizacion', 'filter_date_range')
        ;

        $listener = function(FormEvent $event)
        {
            // Is data empty?
            foreach ($event->getData() as $data) {
                if(is_array($data)) {
                    foreach ($data as $subData) {
                        if(!empty($subData)) return;
                    }
                }
                else {
                    if(!empty($data)) return;
                }
            }

            $event->getForm()->addError(new FormError('Filtro limpio'));
        };
        $builder->addEventListener(FormEvents::POST_SUBMIT, $listener);
    }

    public function getName()
    {
        return 'appbundle_conceptofiltertype';
    }
}
