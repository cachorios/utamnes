<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 20/06/2015
 * Time: 12:03 AM
 */

namespace AppBundle\Libs;


use AppBundle\Entity\Ctacte;
use AppBundle\Entity\Trabajador;
use AppBundle\Model\TrabajadorModel;
use AppBundle\Servicios\EmpleadorActivo;
use RBSoft\UtilidadBundle\Libs\Util;
use Tg\DemoStreamBundle\Helper\FlushHelper;
use AppBundle\Entity\Liquidacion;

class Liquidar
{
    Private $trabModel;
    Private $empAct;
    Private $totales;

    public function __construct(EmpleadorActivo $empleador, TrabajadorModel $trabajadorModel)
    {
        $this->empAct = $empleador;
        $this->trabModel = $trabajadorModel;
    }

    public function procesar(FlushHelper $helper = null)
    {
        $tInicio = Util::microtime_float();
        $this->totales = array();

        $porc = 0;
        $i = 0;

        $trabs = $this->empAct->getTrabajadores();
        $treg = count($trabs);
        foreach ($trabs as $trabajador) {
            $i++;
            $this->setStiloGaouge($helper, $porc);
            $this->liquidar($trabajador);
            $porc = ceil($i / $treg * 100);
        }

        /**
         * Guardar cuenta corriente
         */
        foreach($this->totales as $reg){
            $this->empAct->guardarCuentaCte($this->empAct->getEmpleador(), $this->empAct->getPeriodoActivo(), $reg['concepto'],$reg['total'] );
        }


        $tFin = Util::microtime_float();
        if ($helper) {
            $this->setStiloGaouge($helper, $porc, true);

        }

    }


    private function liquidar(Trabajador $trabajador)
    {

        $this->trabModel->setTrabajor($trabajador);
        $liqs = $this->trabModel->liquidar_global($this->empAct->getPeriodoActivo());

        /**
         * @var Liquidacion $liq
         */
        foreach($liqs as $liq){
            if(!isset($this->totales[$liq->getConcepto()->getId()])){
                $this->totales[$liq->getConcepto()->getId()] = array('concepto' => $liq->getConcepto(), 'total' => 0);
            }
            $this->totales[$liq->getConcepto()->getId()]['total'] += $liq->getImporte();

        }

    }

    private function setStiloGaouge($helper, $pos, $salir = false)
    {
        $id = "progress-value";
        $out = "";
        $out = "<style>#progressbar > div { width: ".$pos."%;}</style>";
        $out .= '<script type="text/javascript">';
        $out .= 'document.getElementById("'.$id.'").innerHTML = "'.htmlentities("$pos %", ENT_QUOTES, 'UTF-8').'" ';
        if($salir)
            $out .=';hacerAlgo();';

        $out .= '</script>';
        $helper->out($out);
    }
}