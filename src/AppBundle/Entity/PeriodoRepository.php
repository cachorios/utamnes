<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PeriodoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PeriodoRepository extends EntityRepository
{
    /**
     * getMaxNumeroLiq
     * Obtiene la liquidacion maxima para un periodo determinado
     * @param Empleador $emp
     * @param $periodo
     * @return int/mixed
     */

    public function getMaxNumeroLiq(Empleador $emp, $periodo)
    {
//        ld($emp,$periodo);
        $q = $this->_em->createQuery(
            "
            Select max(p.liquidacion)
            From AppBundle:Periodo p
            where p.empleador = :empleador AND p.vencimiento = :periodo
             "
        )

            ->setParameter('empleador', $emp->getId())
            ->setParameter('periodo', $periodo);
        $numero = $q->getSingleScalarResult();
        ld($numero);

        return $numero ? $numero + 1 : 0;
    }


}
