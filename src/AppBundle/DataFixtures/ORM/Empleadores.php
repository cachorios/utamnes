<?php
/**
 * Created by PhpStorm.
 * User: cacho
 * Date: 24/05/14
 * Time: 22:21
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Empleador;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Nelmio\Alice\Loader\Yaml;
use Nelmio\Alice\ORM\Doctrine;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class Empleadores extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function getOrder()
    {
        return 10;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        $loader = new Yaml();
        $objs = $loader->load(__DIR__ . '/FIXTURES.YML');
        $persister = new Doctrine($manager);
        $persister->persist($objs);

    }
}
