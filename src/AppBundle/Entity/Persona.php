<?php
<<<<<<< HEAD
=======
namespace AppBundle\Entity;
>>>>>>> 3c1926b9fef51f4a4a60f4dcfe06918d0c639709
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Persona
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
<<<<<<< HEAD
     * @ORM\OneToMany(targetEntity="Trabajador", mappedBy="persona")
     */
    private $trabajador;
}
=======
     * @ORM\Column(type="string", length=11, nullable=false)
     */
    private $cuil;

    /**
     * @ORM\Column(type="string", length=64, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=128, nullable=false)
     */
    private $direccion;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=1, nullable=false)
     */
    private $sexo;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $localidad;

    /**
     * @ORM\Column(type="string", length=1, nullable=false)
     */
    private $estado_civil;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha_actualizacion;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="Trabajador", mappedBy="persona")
     */
    private $trabajador;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->trabajador = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set cuil
     *
     * @param string $cuil
     * @return Persona
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
     * Set nombre
     *
     * @param string $nombre
     * @return Persona
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
     * Set direccion
     *
     * @param string $direccion
     * @return Persona
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
     * Set telefono
     *
     * @param string $telefono
     * @return Persona
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
     * Set email
     *
     * @param string $email
     * @return Persona
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
     * Set sexo
     *
     * @param string $sexo
     * @return Persona
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
     * Set localidad
     *
     * @param integer $localidad
     * @return Persona
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
     * Set estado_civil
     *
     * @param string $estadoCivil
     * @return Persona
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
     * Set fecha_actualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return Persona
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
     * @param string $usuario
     * @return Persona
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add trabajador
     *
     * @param \AppBundle\Entity\Trabajador $trabajador
     * @return Persona
     */
    public function addTrabajador(\AppBundle\Entity\Trabajador $trabajador)
    {
        $this->trabajador[] = $trabajador;

        return $this;
    }

    /**
     * Remove trabajador
     *
     * @param \AppBundle\Entity\Trabajador $trabajador
     */
    public function removeTrabajador(\AppBundle\Entity\Trabajador $trabajador)
    {
        $this->trabajador->removeElement($trabajador);
    }

    /**
     * Get trabajador
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrabajador()
    {
        return $this->trabajador;
    }
}
>>>>>>> 3c1926b9fef51f4a4a60f4dcfe06918d0c639709
