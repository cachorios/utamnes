<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 14/05/2015
 * Time: 08:37 AM
 */

namespace AppBundle\Model;


use Symfony\Component\DependencyInjection\ContainerInterface;

class LiquidacionModel
{

    protected $container;

    protected $empleador;

    public function __construct(ContainerInterface $contenedor)
    {
        $this->container = $contenedor;

        $empleador = $this->getEmpleador();
        //$this->

    }


    /**
     * @return Empleador
     */
    private function getEmpleador()
    {
        $tokenStorage =  $this->container->get('security.token_storage');
        $user = $tokenStorage ->getToken()->getUser();
        $empleador = $this->getEm()->getRepository("AppBundle:Empleador")->findOneByUsuario($user);

        return $empleador;

    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    private function getEm(){
        return  $this->container->get("doctrine.orm.entity_manager");
    }


}