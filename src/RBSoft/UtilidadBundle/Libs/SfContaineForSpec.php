<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 24/03/2015
 * Time: 10:34
 */

namespace RBSoft\UtilidadBundle\Libs;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

require_once __DIR__ . '/../../../../app/bootstrap.php.cache';
require_once __DIR__ . '/../../../../app/AppKernel.php';

trait SfContaineForSpec {
    private $container;

    public function __construct(){

        $kernel = new \AppKernel("dev",true);
        $kernel->loadClassCache();
        $kernel->init();
        $kernel->boot();

        $this->container = $kernel->getContainer();

    }

    public function getContainer(){
        return $this->container;
    }

    private function autenticar($username){
        $user = $this->container->get('fos_user.user_manager')->findUserByUsername($username);
        $providerKey = $this->container->getParameter('fos_user.firewall_name');
        $token = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());
        $this->container->get('security.context')->setToken($token);

    }
}