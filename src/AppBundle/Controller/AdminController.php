<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminController extends Controller
{
    /**
     * @Route("/admin",name="home_admin")
     * @Template()
     */
    public function homeAdminAction()
    {

        return $this->redirect( "profile" );
//        return array(
//                // ...
//            );
    }

}
