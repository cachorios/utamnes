<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 22/03/2015
 * Time: 20:20
 */

namespace AppBundle\Servicios;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;

class EmpleadorActivo {
    private $user;
    private $empleador;
    private $em;



    public function __construct(SecurityContext $context, EntityManager $em){
        $this->user = $context->getToken()->getUser();
        $this->em = $em;
    }

    public function getEmpleador(){
        if($this->empleador === null){
            $this->empleador = $this->em->getRepository("AppBundle:Empleador")->findOneByUsuario($this->user->getId());
        }
        return $this->empleador;
    }

    public function getConceptos()
    {
        $em = $this->em;
        $qb = $em->createQueryBuilder();
        $qb->select("c")
            ->from("AppBundle:Concepto","c")
            ->where("c.activo = 1")
            ->orderBy('c.obligatorio','ASC')
            ->orderBy('c.numero','ASC');

        $q = $qb->getQuery();
        return $q->execute();
    }

} 