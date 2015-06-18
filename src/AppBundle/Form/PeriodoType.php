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
            ->add('vencimiento',null,array("label" => "Periodo"))
            ->add('liquidacion','choice',array("label" => "Nro. de Liquidación",'choices'=>array()))
            ->add('tipo','choice',array("label" => "Presentación","choices" => array()))
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
