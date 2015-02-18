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

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}