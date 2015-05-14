<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use RBSoft\UtilidadBundle\Validator\Constraints as RBAssert;


/**
 * @ORM\Entity
 * @ORM\Table(
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="trabajadorLejajoUk", columns={"empleador_id","legajo"}),
 *         @ORM\UniqueConstraint(name="trabajadorCuitUk", columns={"empleador_id","cuil"})
 *     }
 * )
 */
class Trabajador
{
    use ORMBehaviors\Timestampable\Timestampable;

    static public
        $_ESTDO_CIVIL = array(
            'S' => 'Soltero',
            'C' => 'Casado',
            'D' => 'Divorciado',
            'V' => 'Viudo'
            ),
        $_SEXO = array(
                        'M' => 'Masculino',
                        'F' => 'Femenino'
                    )
        ;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=11, nullable=false)
     * @RBAssert\ContainsCuit
     */
    private $cuil;

    /**
     * @ORM\Column(type="string", length=64, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=1, nullable=false)
     */
    private $sexo;

    /**
     * @ORM\Column(type="string", length=1, nullable=false)
     */
    private $estado_civil;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=64, nullable=false)
     */
    private $localidad;


    /**
     * @ORM\Column(type="string", length=12, nullable=false)
     */
    private $legajo;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_ingreso;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecha_baja;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empleador", inversedBy="trabajador")
     * @ORM\JoinColumn(name="empleador_id", referencedColumnName="id", nullable=false)
     */
    private $empleador;



    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set estado_civil
     *
     * @param string $estadoCivil
     * @return Trabajador
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estado_civil = $estadoCivil;

        return $this;
    }

    /**
     * Get estado_civil
     *
     * @return string
     */
    public function getEstadoCivil()
    {
        return $this->estado_civil;
    }

    /**
     * Set localidad
     *
     * @param integer $localidad
     * @return Trabajador
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return integer
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Trabajador
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Trabajador
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Trabajador
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Trabajador
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Trabajador
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set cuil
     *
     * @param string $cuil
     * @return Trabajador
     */
    public function setCuil($cuil)
    {
        $this->cuil = $cuil;

        return $this;
    }

    /**
     * Get cuil
     *
     * @return string
     */
    public function getCuil()
    {
        return $this->cuil;
    }

    /**
     * Set legajo
     *
     * @param string $legajo
     * @return Trabajador
     */
    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;

        return $this;
    }

    /**
     * Get legajo
     *
     * @return string
     */
    public function getLegajo()
    {
        return $this->legajo;
    }



    /**
     * Set empleador
     *
     * @param \AppBundle\Entity\Empleador $empleador
     * @return Trabajador
     */
    public function setEmpleador(\AppBundle\Entity\Empleador $empleador)
    {
        $this->empleador = $empleador;

        return $this;
    }

    /**
     * Get empleador
     *
     * @return \AppBundle\Entity\Empleador
     */
    public function getEmpleador()
    {
        return $this->empleador;
    }


    public function __toString()
    {
        return $this->getNombre();
    }

    /**
     * Set fecha_ingreso
     *
     * @param \DateTime $fechaIngreso
     * @return Trabajador
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fecha_ingreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fecha_ingreso
     *
     * @return \DateTime 
     */
    public function getFechaIngreso()
    {
        return $this->fecha_ingreso;
    }

    /**
     * Set fecha_baja
     *
     * @param \DateTime $fechaBaja
     * @return Trabajador
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fecha_baja = $fechaBaja;

        return $this;
    }

    /**
     * Get fecha_baja
     *
     * @return \DateTime 
     */
    public function getFechaBaja()
    {
        return $this->fecha_baja;
    }


}
