<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RBSoft\UsuarioBundle\Form\Type;


use RBSoft\UtilidadBundle\Form\DataTransformer\FileToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends AbstractType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->buildUserForm($builder, $options);


        $builder
            ->add("username", null, array('label' => "Usuario"))
            ->add("nombre")
            ->add("telefono")
            ->add("email");
        if ($builder->getData()) {
            $builder
                ->add('foto', 'file', array('required' => false, 'attr' => array("data-imagen" => $builder->getData()->getFoto())));
        } else {
            $builder
                ->add('foto', 'file', array('required' => false));
        }


        $builder
            ->add(
                'current_password',
                'password',
                array(
                    'label' => 'form.current_password',
                    'translation_domain' => 'FOSUserBundle',
                    'mapped' => false,
                    'constraints' => new UserPassword(),
                )
            );

        $builder->get("foto")->addModelTransformer(new FileToStringTransformer());


//        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
//            $usuario = $event->getData();
//            $form = $event->getForm();
//            if($usuario) {
//                //$form->get("foto")->addModelTransformer(new FileToStringTransformer());
//                $form->add(
//                    'foto',
//                    'text',
//                    array('required' => false, 'attr' => array("data-imagen" => $usuario->getFoto()))
//                );
//
//            }
////            $form->get("foto")->addModelTransformer(new FileToStringTransformer());
//
//        });
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => $this->class,
                'intention' => 'profile',
            )
        );
    }

    public function getName()
    {
        return 'usuario_profile';
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'));
    }


}
