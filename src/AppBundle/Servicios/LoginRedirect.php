<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 02/06/2015
 * Time: 10:44 AM
 */

namespace AppBundle\Servicios;



use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;



class LoginRedirect implements AuthenticationSuccessHandlerInterface
{

    private $router;
    public function __construct(UrlGeneratorInterface $route)
    {
        $this->router = $route;
    }


    /**
     * @param Request $request
     * @param TokenInterface $token
     *
     * @return Response never null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $user = $token->getUser();
        $url = $this->router->generate('home_admin');
        if($user->hasRole("ROLE_EMPLEADOR")){
            $url = $this->router->generate('homepage');
        }

        $response = new RedirectResponse($url);
        return $response;

    }
}