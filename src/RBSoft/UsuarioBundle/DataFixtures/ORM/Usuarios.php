<?php
/**
 * Created by PhpStorm.
 * User: cacho
 * Date: 24/05/14
 * Time: 22:21
 */

namespace RBSoft\UsuarioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use RBSoft\UsuarioBundle\Entity\Usuario;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
//use Symfony\Component\Finder\Finder;

class Usuarios extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function getOrder()
    {
        return 101;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $usuarios = array(
            array('login' => 'cachorios', 'nombre' => 'Luis Rios', 'email' => 'cachorios@gmail.com'),
            array('login' => 'albertoe2003', 'nombre' => 'Albero Voeffray', 'email' => 'albertoe2003@gmail.com'),
            array('login' => 'rhfalero', 'nombre' => 'Raul H. Falero', 'email' => 'rhfalero@gmail.com'),
            array('login' => 'fabbrizuela', 'nombre' => 'Gallina Prolija', 'email' => 'fabbrizuela@hotmail.com'),
            array('login' => 'hectorhdc', 'nombre' => 'Hector Cabrera', 'email' => 'hector.d.cabrera@gmail.com'),
            array('login' => 'nibecortla', 'nombre' => 'Nicolas Bertolotti', 'email' => 'nicobertti@gmail.com'),
        );

        foreach ($usuarios as $usu) {
            $usuario = new Usuario();


            $usuario->setLogin($usu['login']);
            $usuario->setNombre($usu['nombre']);
            $usuario->setEmail($usu['email']);


            $salt = md5(time());
            $encoder = $this->container->get('security.encoder_factory')
                        ->getEncoder($usuario);

            $password = $usu['login'];
            $password = $encoder->encodePassword($password , $salt);


            $usuario->setPassword($password);
            $usuario->setSalt($salt);

            $manager->persist($usuario);
        }


        $manager->flush();



    }
}
