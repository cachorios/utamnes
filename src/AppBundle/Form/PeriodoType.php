<?php

namespace AppBundle\Form;

use AppBundle\Entity\Periodo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeriodoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('liquidacion',null,array("label" => "Nro. de Liquidación"))
            ->add('tipo','choice',array("label" => "Presentación","choices" => Periodo::$_TIPO))
            ->add('vencimiento',null,array("label" => "Periodo"))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Periodo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_periodo';
    }
}