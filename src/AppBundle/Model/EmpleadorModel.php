<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 18/02/2015
 * Time: 21:41
 */

namespace AppBundle\Model;


use Doctrine\ORM\EntityManager;

class EmpleadorModel
{
    /**
     * @var \AppBundle\Entity\Empleador
     */
    protected $empleador;

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function setEmpleador(\AppBundle\Entity\Empleador $empleador)
    {
        $this->empleador = $empleador;
    }

    public function guardar()
    {
        $ok = false;

        /**
         * Datos de la modificacion para auditoria
         */
        $this->empleador->setFechaActualizacion(new \DateTime("now"));

        $this->em->beginTransaction();
        try {
            $this->em->persist($this->empleador);
            $this->em->flush();
            $this->em->commit();
            $ok = true;
        }catch (\Exception $e){
            echo "\n".$e->getMessage();
            $this->em->rollback();
            $this->em->close();
        }

        return $ok;
    }

}