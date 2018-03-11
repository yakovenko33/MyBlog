<?php

namespace Bloggr\BlogBundle\Controller;

use Symfony\Component\Form\FormError;
use  Bloggr\BlogBundle\Entity\User;
use  Bloggr\BlogBundle\Entity\Role;
use Bloggr\BlogBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class LoginController extends Controller
{
    /**
     * @Route("/Login", name="login")
     */
    public function LoginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('BlogBundle:Login:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/CheckIn", name="check_in")
     */
    public function CheckInAction(Request $request)
    {

        $user = new User();
        $role = new Role();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $form->getData();


            $repository = $this->getDoctrine()->getRepository(User::class);

            $userName = $repository->findOneBy(array('username' => $user->getUsername()));
            $email = $repository->findOneBy(array('email' => $user->getEmail()));

            if(!is_null($userName)){
                $form->addError(new FormError('Такое имя пользователя занят!'));
                return $this->render('BlogBundle:Login:checkin.html.twig', array(
                    'form' => $form->createView()
                ));
            }

            if(!is_null($email)){
                $form->addError(new FormError('Такой email  занято!'));
                return $this->render('BlogBundle:Login:checkin.html.twig', array(
                    'form' => $form->createView()
                ));
            }


            $this->get('user.service')->coderPassword($user, $role);

             $em = $this->getDoctrine()->getManager();
             $em->persist($user);
             $em->flush();

            return $this->redirectToRoute('login');
        }





        return $this->render('BlogBundle:Login:checkin.html.twig', array(
            'form' => $form->createView()
        ));
    }


}
