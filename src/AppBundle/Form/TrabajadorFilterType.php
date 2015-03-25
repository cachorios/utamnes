<?php

namespace AppBundle\Form;

use Doctrine\ORM\QueryBuilder;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class TrabajadorFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('cuil', 'filter_text')
                ->add('legajo', 'filter_text')
                ->add('nombre', 'filter_text',array("label" => "Apellido y Nombre",
                        'apply_filter' => function (QueryInterface $filterQuery, $field, $values) {
                            if ($values['value']) {
                                $filterQuery->getQueryBuilder()
                                    ->andWhere("lower(q.nombre) like '%" . strtolower($values['value'])."%'");
                            }
                        },
                    ))
                ->add('localidad', 'filter_text',array(
                            'apply_filter' => function (QueryInterface $filterQuery, $field, $values) {
                                if ($values['value']) {
                                    $filterQuery->getQueryBuilder()
                                        ->andWhere("lower(q.localidad) like '%" . strtolower($values['value'])."%'");
                                }
                            },
                ));

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

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'csrf_protection' => false,
                'validation_groups' => array('filtering'), // avoid NotBlank() constraint-related message
            )
        );
    }
    public function getName()
    {
        return 'appbundle_trabajadorfiltertype';
    }
}
