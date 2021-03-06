<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use RBSoft\UtilidadBundle\Libs\Util;
use RBSoft\UtilidadBundle\Validator\Constraints as RBAssert;

/**
 *  @ORM\Table("empleador")
 * @ORM\Entity
 */
class Empleador
{
    use Timestampable;
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Empresa
     *
     *  @ORM\ManyToOne(targetEntity="Empresa")
     */
    private $empresa;


    /**
     * @ORM\Column(type="string", length=64, nullable=false)
     */
    private $razon;

    /**
     * @ORM\Column(type="string", length=11, nullable=false)
     * @RBAssert\ContainsCuit
     */
    private $cuit;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
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
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $localidad;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Trabajador", mappedBy="empleador")
     */
    private $trabajador;


    /**
     * @ORM\ManyToOne(targetEntity="RBSoft\UsuarioBundle\Entity\Usuario", cascade={"all"} )
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="RBSoft\UsuarioBundle\Entity\Usuario")
     */
    private $usuario_actualizador;



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
     * Set razon
     *
     * @param string $razon
     * @return Empleador
     */
    public function setRazon($razon)
    {
        $this->razon = $razon;

        return $this;
    }

    /**
     * Get razon
     *
     * @return string 
     */
    public function getRazon()
    {
        return $this->razon;
    }

    /**
     * Set cuit
     *
     * @param string $cuit
     * @return Empleador
     */
    public function setCuit($cuit)
    {
        $this->cuit = $cuit;

        return $this;
    }

    /**
     * Get cuit
     *
     * @return string 
     */
    public function getCuit()
    {
        return $this->cuit;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Empleador
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
     * @return Empleador
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
     * @return Empleador
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
     * Set localidad
     *
     * @param string $localidad
     * @return Empleador
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return string 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set fecha_actualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return Empleador
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
     * Add trabajador
     *
     * @param \AppBundle\Entity\Trabajador $trabajador
     * @return Empleador
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

    /**
     * Set usuario
     *
     * @param \RBSoft\UsuarioBundle\Entity\Usuario $usuario
     * @return Empleador
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

    public function __toString(){
        return $this->getRazon() . " (". Util::formatCuit($this->cuit) . ")";
    }

    /**
     * Set usuario_actualizador
     *
     * @param \RBSoft\UsuarioBundle\Entity\Usuario $usuarioActualizador
     * @return Empleador
     */
    public function setUsuarioActualizador(\RBSoft\UsuarioBundle\Entity\Usuario $usuarioActualizador = null)
    {
        $this->usuario_actualizador = $usuarioActualizador;

        return $this;
    }

    /**
     * Get usuario_actualizador
     *
     * @return \RBSoft\UsuarioBundle\Entity\Usuario 
     */
    public function getUsuarioActualizador()
    {
        return $this->usuario_actualizador;
    }

    /**
     * Set empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     * @return Empleador
     */
    public function setEmpresa(\AppBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \AppBundle\Entity\Empresa 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }
}
