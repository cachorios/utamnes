<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 22/03/2015
 * Time: 20:20
 */

namespace AppBundle\Servicios;


use AppBundle\Entity\Concepto;
use AppBundle\Entity\Ctacte;
use AppBundle\Entity\Empleador;
use AppBundle\Entity\Periodo;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;

class EmpleadorActivo {
    private $user;
    private $empleador;
    private $em;

    /**
     * @var \AppBundle\Entity\Periodo $periodo
     */
    private $periodo;


    public function __construct(SecurityContext $context, EntityManager $em){
        $this->user = $context->getToken()->getUser();
        $this->em = $em;
    }

    /**
     * @return \AppBundle\Entity\Empleador
     */
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

    public function getPeriodoActivo()
    {
        if($this->periodo === null) {
            $this->periodo = $this->em->getRepository("AppBundle:Periodo")
                ->findOneBy(array(
                    'empleador' => $this->getEmpleador()->getId(),
                    "activo" => 1));
        }
        return $this->periodo;
    }

    /**
     * @return \AppBundle\Entity\Trabajador[]|array
     */
    public function getTrabajadores(){
        $list = $this->em->getRepository("AppBundle:Trabajador")->findBy(array("empleador" => $this->getEmpleador()->getId(),"fecha_baja" => null),array("legajo" => "ASC"));
        return $list;
    }

    public function getImporteFormula(){
        $aImportes = array();
        $aImportes[0] = 0;
        $aImportes[1] = 0;
        $aImportes[3] = 0;

        return $aImportes;
    }


    public function borrarCtacte(Empleador $empleador, Periodo $periodo){
        /**
         * Antes de guardarlo se debe borrar el anterior
         */

        $this->em->createQueryBuilder()
            ->delete("AppBundle:Ctacte",'c')
            ->where("c.empleador = :emp")
            ->andWhere("c.periodo = :periodo")

             ->setParameter("emp", $empleador->getId())
            ->setParameter('periodo', $periodo->getId())
            ->getQuery()
            ->execute();
        return $this;
    }

    public function guardarCuentaCte(Empleador $empleador, Periodo $periodo, Concepto $concepto,$importe){




        $cta = new Ctacte();
        $cta->setEmpleador($empleador)
            ->setPeriodo($periodo)
            ->setConcepto($concepto)
            ->setImporte($importe)
            ->setPago(0);
        ;

        $this->em->persist($cta);
        $this->em->flush();

    }
} 