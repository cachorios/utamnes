<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 17/02/2015
 * Time: 0:56
 */
namespace AppBundle\Tests\Model;


use AppBundle\Entity\Empleador;
use AppBundle\Entity\Persona;
use AppBundle\Model\Trabajador;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;


class TrabajadorTest extends  KernelTestCase{
    /**
     * @var \Doctrine\ORM\EntityManager;
     */
    private $em;

    /**
     * @var \AppBundle\Model\Trabajador
     */
    private $trabajadorModel;
    public function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')->getManager();

        $user_st = static::$kernel->getContainer()->get('security.token_storage');

        $user_st->setToken($this->logIn());

        $this->trabajadorModel = new Trabajador($this->em,$user_st);


    }

    private function logIn(){
        $session = static::$kernel->getContainer()->get('session');
        $firewall = "main";

        $user = $this->em->getRepository("UsuarioBundle:Usuario")->findOneBy(array("username" =>"cachorios"));

        $token = new UsernamePasswordToken($user,'11',$firewall,array("ROLE_ADMIN"));


        $session->set('_security_'.$firewall, serialize($token));
        $session->save();
        return $token;
    }


    /**
     * Este escenario lee los conceptos obligatorios a asignar, siempre deben ser 2!!!
     */
    public function testGetConceptosObligatorios()
    {
        $conceptos = $this->trabajadorModel->getConceptosObligatorios();
        $this->assertTrue(count($conceptos) == 2, "Verificando conceptos, los obligatorios son 2");
    }

    /**
     * Mando una coleccion vacia, si agrega debera regresar true
     */
    public function testagregarConceptosObligatorios(){
        $this->trabajadorModel->iniciar(new \AppBundle\Entity\Trabajador(),new \Doctrine\Common\Collections\ArrayCollection());

        $this->assertTrue($this->trabajadorModel->agregarConceptosObligatorios(),"Minimamente son dos conceptos");
    }

    /**
     *
     */
    public function testGuardar(){

        //Escenario 1 una persona, sin conceptos seleccionados
        //Probar una persona nueva

        $trabajador = new \AppBundle\Entity\Trabajador();
        $trabajador->setEmpleador($this->getEmpleador());
        $trabajador->setLegajo(100);
        $trabajador->setNombre("Luis rios");
        $trabajador->setCuil("20204894532");
        $trabajador->setSexo("M");
        $trabajador->setEstadoCivil("S");
        $trabajador->setEmail("cachorios@gmail.com");
        $trabajador->setTelefono("4475212");
        $trabajador->setDireccion("Ch. 113");
        $trabajador->setLocalidad("Posadas");

        $this->trabajadorModel->iniciar($trabajador,new \Doctrine\Common\Collections\ArrayCollection());

        $this->assertTrue($this->trabajadorModel->guardar(),"Guardar en bdd");

        //Escenario 2
        $trabajador = new \AppBundle\Entity\Trabajador();
        $trabajador->setEmpleador($this->getEmpleador());
        $trabajador->setLegajo(100);
        $trabajador->setNombre("Luis rios");
        $trabajador->setCuil("20204894532");
        $trabajador->setSexo("M");
        $trabajador->setEstadoCivil("S");
        $trabajador->setLocalidad("Posadas");


        $collection = new ArrayCollection();

        //Cuota gremial
        $collection->add( $this->em->getRepository("AppBundle:Concepto")->findOneBy(array("numero" => 401)));
        //Seguro Funerario
        $collection->add( $this->em->getRepository("AppBundle:Concepto")->findOneBy(array("numero" => 412)));

        $this->trabajadorModel->iniciar($trabajador, $collection);
        $this->assertTrue($this->trabajadorModel->guardar(),"Guardar en bdd");

        //Escenario 3
        $trabajador = new \AppBundle\Entity\Trabajador();
        $trabajador->setEmpleador($this->getEmpleador());
        $trabajador->setLegajo(100);
        $trabajador->setNombre("Luis rios");
        $trabajador->setCuil("20204894532");
        $trabajador->setSexo("M");
        $trabajador->setEstadoCivil("S");
        $trabajador->setLocalidad("Posadas");

        $collection = new ArrayCollection();

        //Cuota gremial
        $collection->add( $this->em->getRepository("AppBundle:Concepto")->findOneBy(array("numero" => 401)));
        //Seguro Funerario
        $collection->add( $this->em->getRepository("AppBundle:Concepto")->findOneBy(array("numero" => 412)));
        // y otro no obligatorio
        $collection->add( $this->em->getRepository("AppBundle:Concepto")->findOneBy(array("numero" => 451)));


        $this->trabajadorModel->iniciar($trabajador, $collection);
        $this->assertTrue($this->trabajadorModel->guardar(),"Guardar en bdd");

    }

    private function getEmpleador(){
        $ret = $this->em->getRepository("AppBundle:Empleador")->findAll();
        return $ret[0];
    }
}