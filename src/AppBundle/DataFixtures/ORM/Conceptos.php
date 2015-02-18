<?php
/**
 * Created by PhpStorm.
 * User: cacho
 * Date: 24/05/14
 * Time: 22:21
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Concepto;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class Conceptos extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function getOrder()
    {
        return 20;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $arrs = array(
            array('numero' => 401, 'descripcion' => 'Cuota Gremial',                'descripcion_corta' => 'Cuota Grem.',   'obligatorio' => true,  'activo' => true ),
            array('numero' => 412, 'descripcion' => 'Seguro Funerario',             'descripcion_corta' => 'Seg. Fun.',     'obligatorio' => true,  'activo' => true ),
            array('numero' => 437, 'descripcion' => 'Seguro de Vida',               'descripcion_corta' => 'Seguro Vida',   'obligatorio' => true,  'activo' => false ),
            array('numero' => 451, 'descripcion' => 'Seguro Familiar Colectivo',    'descripcion_corta' => 'Seg. col',      'obligatorio' => false, 'activo' => true ),
            array('numero' => 480, 'descripcion' => 'Complemento OB. Social',       'descripcion_corta' => 'Comp.Ob.Soc.',  'obligatorio' => false, 'activo' => true ),
            array('numero' => 485, 'descripcion' => 'Prestamo mutual UTA',          'descripcion_corta' => 'Prestamo UTA',  'obligatorio' => false, 'activo' => true )
        );

        foreach ($arrs as $a) {
            $o = new Concepto();

            $o->setNumero($a['numero']);
            $o->setDescripcion($a['descripcion']);
            $o->setDescripcionCorta($a['descripcion_corta']);
            $o->setObligatorio($a['obligatorio']);
            $o->setActivo($a['activo']);
            $o->setUsuario('cachorios@gmail.com');
            $o->setFechaActualizacion(new \DateTime('now'));
            $o->setUsuario(null);

            $manager->persist($o);
            $manager->flush();
            //$this->addReference($o->getCategoria()->getNombre().'-'.$o->getNombre(), $o);
        }

    }
}
