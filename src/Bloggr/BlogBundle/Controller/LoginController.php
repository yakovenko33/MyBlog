<?php

namespace Bloggr\BlogBundle\Controller;

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
    public function LoginAction()
    {
        /*$em = $this->getDoctrine()->getManager();
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
        $em->flush();*/





        return $this->render('BlogBundle:Login:login.html.twig', array(

        ));
    }

    /**
     * @Route("/CheckIn", name="check_in")
     */
    public function CheckInAction(Request $request)
    {

       /*$productId = 1;

        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($productId);

        $categoryName = $user->getRoles();
        foreach ($categoryName as $role){
            print_r($user->getUsername());
        print_r( $role->getRole());
        }*/

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();

            return $this->redirectToRoute('BlogBundle:Login:login.html.twig');
        }





        return $this->render('BlogBundle:Login:checkin.html.twig', array(
            'form' => $form->createView()
        ));
    }


}
