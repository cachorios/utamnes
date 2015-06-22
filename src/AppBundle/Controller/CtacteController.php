<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 21/06/2015
 * Time: 12:30 PM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * Class CtacteController
 * @package AppBundle\Controller
 * @Route("app/ctacte")
 * @Template
 */
class CtacteController  extends Controller{

    /**
     * @return array
     * @Route("/", name="ctacte")
     */
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $ctactes = $em->getRepository("AppBundle:Ctacte")->getCtactesQB($this->get("uta.empleador_activo")->getEmpleador())
            ->getQuery()
            ->execute();
        return array("ctactes" => $ctactes);
    }
}