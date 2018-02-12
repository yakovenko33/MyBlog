<?php

namespace Bloggr\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class UsersController extends Controller
{
    /**
     * @Route("/Admin", name="admin")
     */
    public function AdminAction()
    {
        return $this->render('BlogBundle:Users:admin.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/Users", name="users")
     */
    public function UsersAction()
    {
        return $this->render('BlogBundle:Users:users.html.twig', array(
            // ...
        ));
    }
}
