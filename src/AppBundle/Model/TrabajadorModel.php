<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 13/02/2015
 * Time: 23:47
 */

namespace AppBundle\Model;


use AppBundle\Entity\DatoLiquidacion;
use AppBundle\Entity\Empleador;
use AppBundle\Entity\Liquidacion;
use AppBundle\Entity\Periodo;
use AppBundle\Entity\Trabajador;
use AppBundle\Entity\TrabajadorConcepto;
use AppBundle\Servicios\EmpleadorActivo;
use Doctrine\Common\Collections\ArrayCollection;
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
    protected $empleadorSrv;

    public function __construct(EntityManager $em, EmpleadorActivo $empleadorActivo)
    {
        $this->em = $em;
        $this->empleadorSrv = $empleadorActivo;

//        $this->empModel = $empModel;

    }

    /**
     * @return Empleador
     */
    public function getEmpleadorActivo()
    {
        return $this->empleadorSrv->getEmpleador();
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

            $trabajador->setEmpleador($this->empleadorSrv->getEmpleador());
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


    /**
     * @param Trabajador $tra
     */
    public function setTrabajor(Trabajador $tra)
    {
        $this->trabajador = $tra;
    }

    /**
     * @param $id
     */
    public function setTrabajadorId($id)
    {
        $this->trabajador = $this->em->getRepository("AppBundle:Trabajador")->find($id);
    }

    public function getTrabajador()
    {
        return $this->trabajador;
    }

    public function getDatoLiquidacion(Periodo $periodo)
    {
        $dato = $this->em->getRepository("AppBundle:DatoLiquidacion")->findOneBy(
            array("periodo" => $periodo->getId(), "trabajador" => $this->trabajador->getId())
        );

        return $dato;
    }

    /**
     * @param Periodo $periodo
     * @param bool liqGlobal //Si liquida global
     * @return array
     */
    public function getArrayDatosImporte(Periodo $periodo, $liqGlobal = false)
    {

        if($liqGlobal == true)
            $importes = array();
        else
            $importes = $this->empleadorSrv->getImporteFormula();


        $dato = $this->getDatoLiquidacion($periodo);

        if ($dato) {
            if ($liqGlobal == true) {
                if($dato->getTr()<>0)
                    $importes['tr'] = $dato->getTr();
                if($dato->getImp1()<>0)
                    $importes['imp1'] = $dato->getImp1();
                if($dato->getImp2()<>0)
                    $importes['imp2'] = $dato->getImp2();
                if($dato->getImp3()<>0)
                    $importes['imp3'] = $dato->getImp3();
                if($dato->getImp4()<>0)
                    $importes['imp4'] = $dato->getImp4();
                if($dato->getImp5()<>0)
                    $importes['imp5'] = $dato->getImp5();
                if($dato->getImp6()<>0)
                    $importes['imp6'] = $dato->getImp6();
                if($dato->getImp8()<>0)
                    $importes['imp7'] = $dato->getImp7();
                if($dato->getImp9()<>0)
                    $importes['imp8'] = $dato->getImp8();
                if($dato->getImp9()<>0)
                    $importes['imp9'] = $dato->getImp9();
            } else {
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
        }

        return $importes;
    }


    public function getLiquidacion(Periodo $periodo)
    {
        $liqs = $this->em->getRepository("AppBundle:Liquidacion")->findBy(
            array("trabajador" => $this->getTrabajador()->getId(), "periodo" => $periodo->getId())
        );
        $conceptos = $this->em->getRepository("AppBundle:Concepto")->findBy(
            array(),
            array("obligatorio" => "DESC", 'numero' => "ASC")
        );

        foreach ($conceptos as $conc) {
            $f = 0;
            foreach ($liqs as $liq) {
                if ($liq->getConcepto()->getId() == $conc->getId()) {
                    $f = 1;
                }
            }
            if ($f == 0) {
                $nLiq = new Liquidacion();
                $nLiq->setConcepto($conc);
                $liqs[] = $nLiq;
            }
        }

        return $liqs;
    }

    /**
     * @param Periodo $periodo
     * @param $datos
     * @param $concs
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function liquidar(Periodo $periodo, $datos, $concs)
    {
        $concsLiq = $this->getConceptosLiquidar($concs);

        $liqs = new \Doctrine\Common\Collections\ArrayCollection();

        foreach ($concsLiq as $conc) {
            $formula = $this->replaceVarIntoFormula($conc->getFormula(), $datos);
            $result = 0;
            eval($formula);
            if ($result <> 0) {
                $liq = new Liquidacion();
                $liq->setTrabajador($this->getTrabajador());
                $liq->setPeriodo($periodo);
                $liq->setConcepto($conc);
                $liq->setImporte($result);
                $liqs->add($liq);
            }

        }

        return $liqs;
    }

    public function liquidar_global(Periodo $periodo)
    {
        $datos = $this->getArrayDatosImporte($periodo, true);

        $liqsDato = $this->getLiquidacion($periodo);
        $liqs = $this->liquidar($periodo, $datos, $liqsDato);
        $this->liquidacionSave($periodo, $liqs, $datos);

        return $liqs;
    }

    public function liquidacionSave(Periodo $periodo, ArrayCollection $liqs, $datos)
    {
        if (!$datosLiq = $this->getDatoLiquidacion($periodo)) {
            $datosLiq = new DatoLiquidacion();
            $datosLiq->setTrabajador($this->getTrabajador());
            $datosLiq->setPeriodo($periodo);
        }

        $datosLiq->setTr(isset($datos['tr']) ? $datos['tr'] : 0);
        $datosLiq->setImp1(isset($datos['imp1']) ? $datos['imp1'] : 0);
        $datosLiq->setImp2(isset($datos['imp2']) ? $datos['imp2'] : 0);
        $datosLiq->setImp3(isset($datos['imp3']) ? $datos['imp3'] : 0);
        $datosLiq->setImp4(isset($datos['imp4']) ? $datos['imp4'] : 0);
        $datosLiq->setImp5(isset($datos['imp5']) ? $datos['imp5'] : 0);
        $datosLiq->setImp6(isset($datos['imp6']) ? $datos['imp6'] : 0);
        $datosLiq->setImp7(isset($datos['imp7']) ? $datos['imp7'] : 0);
        $datosLiq->setImp8(isset($datos['imp8']) ? $datos['imp8'] : 0);
        $datosLiq->setImp9(isset($datos['imp9']) ? $datos['imp9'] : 0);

        $this->em->persist($datosLiq);
        //Borrar las liquidaciones
        $this->em->getRepository("AppBundle:Liquidacion")->createQueryBuilder("")
            ->delete("AppBundle:Liquidacion", 'l')
            ->where("l.trabajador = ".$this->getTrabajador()->getId())
            ->andWhere("l.periodo= ".$periodo->getId())
            ->getQuery()
            ->execute();

        foreach ($liqs as $liq) {
            $this->em->persist($liq);
        }

        $this->em->flush();
    }

    private function replaceVarIntoFormula($formula, $datos)
    {
        $vars = array("[TR]", "[IMP1]", "[IMP2]", "[IMP3]", "[IMP4]", "[IMP5]", "[IMP6]", "[IMP7]", "[IMP8]", "[IMP9]");
        $valor = array(
            'tr' => 0,
            'imp1' => 0,
            'imp2' => 0,
            'imp3' => 0,
            'imp4' => 0,
            'imp5' => 0,
            'imp6' => 0,
            'imp7' => 0,
            'imp8' => 0,
            'imp9' => 0
        );

        foreach ($datos as $k => $v) {
            $valor[$k] = $v;
        }
        $formula = "\$result =  ".str_replace($vars, $valor, $formula).";";

        return $formula;
    }


    /**
     * @param $concs
     * @return \Doctrine\Common\Collections\Collection
     */

    private function getConceptosLiquidar($concs)
    {
        $concsLiq = $this->getConceptosObligatorios();

        //verificar que en concs haya conc no obligatorios, para incluirlo
        foreach ($concs as $i => $conc) {
            $concno = $this->em->getRepository("AppBundle:Concepto")->findOneBy(
                array("numero" => $i, "obligatorio" => 0)
            );
            if (!$concno == null) {
                $concsLiq->add($concno);
            }
        }

        return $concsLiq;
    }

}
