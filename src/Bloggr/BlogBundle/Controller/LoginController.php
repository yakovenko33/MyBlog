<?php

namespace Bloggr\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use  Bloggr\BlogBundle\Entity\User;
use  Bloggr\BlogBundle\Entity\Role;


class LoginController extends Controller
{
    /**
     * @Route("/Login", name="login")
     */
    public function LoginAction()
    {
        $em = $this->getDoctrine()->getManager();
        $role = new Role();
        $role->setRole('ROLE_ADMIN');

        $user = new User();
        $user->setUsername('Vlad Yakovenko');
        $user->setEmail('botvot33@gmail.com');
        $user->setPassword('123ert678');
        $user->setSalt('876tre321');


        $user->addRole($role);

        $em->persist($role);
        $em->persist($user);
        $em->flush();


        return $this->render('BlogBundle:Login:login.html.twig', array(

        ));
    }

    /**
     * @Route("/CheckIn", name="check_in")
     */
    public function CheckInAction()
    {

        $productId = 1;

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($productId);


        $categoryName = $user->getRoles()->getRole;

        print_r( $categoryName);
        exit;

        return $this->render('BlogBundle:Login:login.html.twig', array(
        ));
    }


}
