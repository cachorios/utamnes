<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 15/03/2015
 * Time: 19:53
 */

namespace RBSoft\UsuarioBundle\Model;



use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManager;
use FOS\UserBundle\Util\CanonicalizerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UsuarioManager extends UserManager
{


    /**
     * Constructor.
     *
     * @param EncoderFactoryInterface $encoderFactory
     * @param CanonicalizerInterface  $usernameCanonicalizer
     * @param CanonicalizerInterface  $emailCanonicalizer
     */
    public function __construct(EncoderFactoryInterface $encoderFactory, CanonicalizerInterface $usernameCanonicalizer, CanonicalizerInterface $emailCanonicalizer)
    {
        $this->encoderFactory = $encoderFactory;
        $this->usernameCanonicalizer = $usernameCanonicalizer;
        $this->emailCanonicalizer = $emailCanonicalizer;
    }

    /**
     * Deletes a user.
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function deleteUser(UserInterface $user)
    {
        // TODO: Implement deleteUser() method.
        throw new \Exception("Falta Implementar: " . __METHOD__);
    }

    /**
     * Finds one user by the given criteria.
     *
     * @param array $criteria
     *
     * @return UserInterface
     */
    public function findUserBy(array $criteria)
    {
        // TODO: Implement findUserBy() method.
        throw new \Exception("Falta Implementar: " . __METHOD__);
    }

    /**
     * Returns a collection with all user instances.
     *
     * @return \Traversable
     */
    public function findUsers()
    {
        // TODO: Implement findUsers() method.
        throw new \Exception("Falta Implementar: " . __METHOD__);
    }

    /**
     * Returns the user's fully qualified class name.
     *
     * @return string
     */
    public function getClass()
    {
        return __CLASS__;
    }


    /**
     * Returns an empty user instance
     *
     * @return UserInterface
     */
    public function createUser()
    {
        $class = $this->getClass();
        $user = new $class;

        return $user;
    }

    /**
     * Reloads a user.
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function reloadUser(UserInterface $user)
    {
        // TODO: Implement reloadUser() method.
        throw new \Exception("Falta Implementar: " . __METHOD__);
    }

    /**
     * Updates a user.
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function updateUser(UserInterface $user)
    {
        // TODO: Implement updateUser() method.
        throw new \Exception("Falta Implementar: " . __METHOD__);
    }
}