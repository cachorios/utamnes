<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 03/02/2015
 * Time: 6:57
 */

namespace RBSoft\UsuarioBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class Usuario extends BaseUser {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Trabajador", mappedBy="usuario")
     */
    private $trabajador;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Empleador", mappedBy="usuario")
     */
    private $empleador;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Concepto", mappedBy="usuario")
     */
    private $concepto;

    /**
     * @var String $nombre
     * @ORM\Column(type="string", length=64)
     */
    private $nombre;

    /**
    * @var String $telefono
    * @ORM\Column(type="string", length=64, nullable=true)
    */
    private $telefono;
    /**
     * @var String $movil
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $movil;


    /**
     * @var String $foto
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $foto;


    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
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
     * Set telefono
     *
     * @param string $telefono
     * @return Usuario
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
     * Set movil
     *
     * @param string $movil
     * @return Usuario
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;

        return $this;
    }

    /**
     * Get movil
     *
     * @return string 
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set foto
     *
     * @param string | UpdloadFile $foto
     * @return Usuario
     */
    public function setFoto($foto)
    {


        if($foto instanceof UploadedFile  )
            if($foto->getError() == '0'  ){
                $fileName = uniqid("user") .'.'.  $foto->getClientOriginalExtension();
                $dir = __DIR__.'/../../../../web/uploads/users';

                $foto->move($dir, $fileName  );
                $this->foto = $fileName;
            }else
                throw new \Exception("Error en imagen");

        elseif($foto)
                $this->foto = $foto;


        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Add trabajador
     *
     * @param \AppBundle\Entity\Trabajador $trabajador
     * @return Usuario
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
     * Add empleador
     *
     * @param \AppBundle\Entity\Empleador $empleador
     * @return Usuario
     */
    public function addEmpleador(\AppBundle\Entity\Empleador $empleador)
    {
        $this->empleador[] = $empleador;

        return $this;
    }

    /**
     * Remove empleador
     *
     * @param \AppBundle\Entity\Empleador $empleador
     */
    public function removeEmpleador(\AppBundle\Entity\Empleador $empleador)
    {
        $this->empleador->removeElement($empleador);
    }

    /**
     * Get empleador
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmpleador()
    {
        return $this->empleador;
    }

    /**
     * Add concepto
     *
     * @param \AppBundle\Entity\Concepto $concepto
     * @return Usuario
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
