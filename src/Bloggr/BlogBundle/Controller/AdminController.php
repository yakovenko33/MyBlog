<?php

namespace Bloggr\BlogBundle\Controller;

use  Bloggr\BlogBundle\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bloggr\BlogBundle\Form\AdminType;

class AdminController extends Controller
{
    /**
     * @Route("/Admin", name="admin")
     */
    public function AdminAction(Request $request)
    {
        $blog = new Blog;

        $form = $this->createForm(AdminType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();

        }


        return $this->render('BlogBundle:Admin:admin.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
