<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 18/02/2015
 * Time: 21:41
 */

namespace AppBundle\Model;


use AppBundle\Entity\Empleador;
use RBSoft\UsuarioBundle\Entity\Usuario;
use Symfony\Component\DependencyInjection\ContainerInterface;


class EmpleadorModel
{
    /**
     * @var \AppBundle\Entity\Empleador
     */
    protected $empleador;
    protected $container;

    public function __construct(ContainerInterface $contonedor)
    {
        $this->container = $contonedor;
    }

    /**
     * @param Empleador $empleador
     * @return $this
     */
    public function setEmpleador(Empleador $empleador)
    {
        $this->empleador = $empleador;

        return $this;
    }

    public function guardar()
    {
        $ok = false;

        /**
         * Datos de la modificacion para auditoria
         */
        $this->empleador->setFechaActualizacion(new \DateTime("now"));

        $usuario_autenticado = $this->container->get("security.context")->getToken()->getUser();
        $this->empleador->setUsuarioActualizador($usuario_autenticado);

        $em = $this->container->get("doctrine.orm.entity_manager");
        $em->beginTransaction();
        $userCreate = false;
        try {

            if ($this->empleador->getId() == null) {
                $userCreate = true;
            }

            $em->persist($this->empleador);

            $em->flush();
            $em->commit();

            if ($userCreate) {
                $userManager = $this->container->get("fos_user.user_manager");

                $user = $userManager->createUser();
                $user->setUsername($this->empleador->getCuit()); //Será el cuit del empleador
                $user->setNombre($this->empleador->getRazon());
                $user->setEmail($this->empleador->getEmail());
                $pass = $this->getInicialPsw();
                $user->setPlainPassword($pass);
                $user->addRole("ROLE_EMPLEADOR");

                $userToEmail = clone $user;
                $userManager->updateUser($user, true);
                $this->empleador->setUsuario($user);

                $userToEmail->setPlainPassword($pass);
                $this->sendMail($userToEmail, $user);
            }


            $ok = true;
        } catch (\Exception $e) {
            echo "\n".$e->getMessage();
            $this->em->rollback();
            $this->em->close();
        }

        return $ok;
    }

    private function getInicialPsw()
    {
        $prefijos = array("Lar", "LAR", "LAr", "L_A_R", "L-A-R", "EA", "eA", "Taragui", "MunDo");

        return $prefijos[rand(0, count($prefijos) - 1)] . substr(microtime(), 2, 6);

    }

    public function sendMail(Usuario $usuario, Usuario $user)
    {

        /**
         * El user tiene el clon de usuario con la clave no encriptada, hay que agregarlo el token
         */
        $user->setEnabled(false);
        if (null === $usuario->getConfirmationToken()) {
            $tokenGenerator = $this->container->get("fos_user.util.token_generator");
            $token = $tokenGenerator->generateToken();
            $user->setConfirmationToken($token);
            $usuario->setConfirmationToken($token);
        }
        $userManager = $this->container->get("fos_user.user_manager");
        $userManager->updateUser($user);

        $mailer = $this->container->get("fos_user.mailer");
        $mailer->sendConfirmationEmailMessage($usuario);

    }
}