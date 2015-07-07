<?php

namespace AppBundle\Form;

use AppBundle\Entity\Periodo;
use Proxies\__CG__\AppBundle\Entity\Liquidacion;
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
        $datos = $options['data'];

        if($datos->getId()){
            $builder
                ->add('vencimiento',null,array('label' =>"Periodo" , 'disabled' => true));
        }else{
            $builder
                ->add('vencimiento',null,array('label' =>"Periodo"));
        }

        $builder
            ->add('liquidacion',null,array("label" => "Nro. de Liquidación" , 'read_only' => true))
//            ->add('tipo',null,array("label" => "Presentación" , 'disabled' => true))
            ->add('descripcion',null,array("label" => "Descripcion" , 'required' => true))
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
