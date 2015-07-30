<?php
/**
 * Created by PhpStorm.
 * User: Luis
 * Date: 14/07/2015
 * Time: 10:36
 */

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class DatoLiquidacionRepository extends  EntityRepository
{
    public function copyDatoLiquidacion(Periodo $origen, Periodo $destino)
    {
        $rs = $this->_em->createQuery(
            "
            Select dl
            From AppBundle:DatoLiquidacion dl
            where dl.periodo = :origen
             "
        )
            ->setParameter("origen", $origen->getId())
            ->execute();

        foreach($rs as $dato){
            $newDato = clone $dato;
            $newDato->setPeriodo($destino);
            $this->_em->persist($newDato);
        }


    }


}