<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Trabajador
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1, nullable=false)
     */
    private $estado_civil;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $localidad;

    /**
     * @ORM\Column(type="string", length=1, nullable=false)
     */
    private $sexo;

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
    private $nombre;

    /**
     * @ORM\Column(type="string", length=11, nullable=false)
     */
    private $cuil;

    /**
     * @ORM\Column(type="string", length=12, nullable=false)
     */
    private $legajo;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_actualizacion;

    /**
     * @ORM\ManyToOne(targetEntity="RBSoft\UsuarioBundle\Entity\Usuario", inversedBy="trabajador")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id",  nullable=true)
     */
    private $usuario;

    /**
     * 
     */
    private $trabajadorConcepto;

    /**
     * 
     * 
     @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empleador", inversedBy="trabajador")
     @ORM\JoinColumn(name="empleador_id", referencedColumnName="id", nullable=false)*/
    private $empleador;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Concepto", mappedBy="trabajador", cascade={"persist"})
     */
    private $concepto;

    /**
     * 
     * 
     */
    private $persona;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->concepto = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fecha_actualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return Trabajador
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fecha_actualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Get fecha_actualizacion
     *
     * @return \DateTime 
     */
    public function getFechaActualizacion()
    {
        return $this->fecha_actualizacion;
    }

    /**
     * Set usuario
     *
     * @param \RBSoft\UsuarioBundle\Entity\Usuario $usuario
     * @return Trabajador
     */
    public function setUsuario(\RBSoft\UsuarioBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \RBSoft\UsuarioBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
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

    /**
     * Add concepto
     *
     * @param \AppBundle\Entity\Concepto $concepto
     * @return Trabajador
     */
    public function addConcepto(\AppBundle\Entity\Concepto $concepto)
    {
        $this->concepto[] = $concepto;

        return $this;
    }

    /**
     * Remove concepto
     *
     * @param \AppBundle\Entity\Concepto $concepto
     */
    public function removeConcepto(\AppBundle\Entity\Concepto $concepto)
    {
        $this->concepto->removeElement($concepto);
    }

    /**
     * Get concepto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConcepto()
    {
        return $this->concepto;
    }
}
