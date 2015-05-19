<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 14/05/2015
 * Time: 09:30 AM
 */

namespace AppBundle\Twig\Extension;


use AppBundle\Entity\Empleador;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UtaExtension  extends \Twig_Extension
{
    private $container ;
    public function __construct(ContainerInterface $contenedor)
    {
        $this->container = $contenedor;
    }


    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return "uta.twig";
    }

    public function getFunctions()
    {
        return array(
            'empleadorActivo' => new \Twig_Function_Method($this, 'empleadorActivo'),

        );
    }

    /**
     * @return Empleador
     */
    public function getEmpleadorActivo(){
        return $this->container->get("uta.empleador_activo")->getEmpleador();

    }


}
