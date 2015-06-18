<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/02/2015
 * Time: 23:47
 */

namespace AppBundle\Model;


use AppBundle\Entity\Empleador;
use AppBundle\Entity\Liquidacion;
use AppBundle\Entity\Periodo;
use AppBundle\Entity\Trabajador;
use AppBundle\Entity\TrabajadorConcepto;
use AppBundle\Servicios\EmpleadorActivo;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContextInterface;


class TrabajadorModel
{

    /**
     * @var \AppBundle\Entity\Trabajador
     */
    protected $trabajador;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $conceptos;

    protected $em;
    /**
     * @var \AppBundle\Entity\Empleador
     */
    protected $empleador;


//, EmpleadorModel $empModel
    public function __construct(EntityManager $em, EmpleadorActivo $empleadorActivo)
    {
        $this->em = $em;
        $this->empleador = $empleadorActivo->getEmpleador();
//        $this->empModel = $empModel;

    }


    /**
     * @return \Doctrine\Common\Collections\Collection
     */

        public function getConceptosObligatorios()
        {

            $conceptos = $this->em->getRepository('AppBundle:Concepto')
                ->findBy(
                    array(
                        'obligatorio' => true,
                        'activo' => true
                    )
                );


            return $conceptos;
        }


    public function guardar(Trabajador $trabajador, $conceptos_original = null)
    {

      //  $this->asignarConceptosObligatorios($trabajador);

        $this->em->beginTransaction();

        try {
            //$trabajador->setUsuario($this->empleador->getUsuario());

            $trabajador->setEmpleador($this->empleador);
            $this->em->persist($trabajador);
            $this->em->flush();
            $this->em->commit();

        } catch (\Exception $e) {
            $this->em->rollback();
            $this->em->close();
            throw new \Exception($e->getMessage());

        }

        return true;
    }


    public function setTrabajadorId($id){
        $this->trabajador = $this->em->getRepository("AppBundle:Trabajador")->find($id);
    }

    public function getTrabajador(){
        return $this->trabajador;
    }
    public function getDatoLiquidacion(Periodo $periodo){
        $dato = $this->em->getRepository("AppBundle:DatoLiquidacion")->findOneBy(array("periodo" => $periodo->getId(), "trabajador" => $this->trabajador->getId()));
        return $dato;
    }

    public function getArrayDatosImporte(Periodo $periodo, $importes = array()){

        $dato = $this->getDatoLiquidacion($periodo);

        if($dato) {
            foreach ($importes as $i => $v) {
                switch ($i) {
                    case 0:
                        $importes[0] = $dato->getTr();
                        break;
                    case 1:
                        $importes[1] = $dato->getImp1();
                        break;
                    case 2:
                        $importes[2] = $dato->getImp2();
                        break;
                    case 3:
                        $importes[3] = $dato->getImp3();
                        break;
                    case 4:
                        $importes[4] = $dato->getImp4();
                        break;
                    case 5:
                        $importes[5] = $dato->getImp5();
                        break;
                    case 6:
                        $importes[6] = $dato->getImp6();
                        break;
                    case 7:
                        $importes[7] = $dato->getImp7();
                        break;
                    case 8:
                        $importes[8] = $dato->getImp8();
                        break;
                    case 9:
                        $importes[9] = $dato->getImp9();
                        break;
                }
            }
        }
        return $importes;
    }


    public function getLiquidacion(Periodo $periodo)
    {
        $liqs = $this->em->getRepository("AppBundle:Liquidacion")->findBy(array("trabajador" => $this->getTrabajador()->getId(),"periodo" => $periodo->getId()));
        $conceptos = $this->em->getRepository("AppBundle:Concepto")->findBy(array(),array("obligatorio" => "DESC",'numero' => "ASC") );

        foreach($conceptos as $conc){
           $f=0;
           foreach($liqs as $liq){
                if($liq->getConcepto()->getId() == $conc->getId()){
                    $f = 1;
                }
           }
            if($f== 0){
                $nLiq = new Liquidacion();
                $nLiq->setConcepto($conc);
                $liqs[] = $nLiq;
            }
        }

        return $liqs;
    }
}
