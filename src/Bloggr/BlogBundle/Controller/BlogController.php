<?php

namespace Bloggr\BlogBundle\Controller;

use Bloggr\BlogBundle\Entity\Comments;
use Bloggr\BlogBundle\Service;
use Bloggr\BlogBundle\Service\BlogService;
use Bloggr\BlogBundle\Entity\Blog;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Bloggr\BlogBundle\Form\CommentType;


class BlogController extends Controller
{
    /**
     * @Route("/Blog", name="blog")
     */
    public function aboutAction(Request $request)
    {
        $repository = $this->getDoctrine()
            ->getRepository(Blog::class);

        //$product = $repository->findAll();

        $blogs = $repository->createQueryBuilder('b')
            ->addOrderBy('b.created', 'DESC')
            ->getQuery()
            ->getResult();

        $paginator  = $this->get('knp_paginator');

        $resault = $paginator->paginate(
            $blogs, /* query NOT result */
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
            /*limit per page*/
        );

        return $this->render('BlogBundle:Blog:blog.html.twig',
            array( 'blogs' => $resault
        ));
    }

    /**
     *
     * @Route("/Blog/{id}", name="article")
     */
    public function articleAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository(Blog::class)->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        $user = $this->getUser();
        $comment = new Comments();

        $form = $this->createForm(CommentType::class,  $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();

            $comment->setUser($user);
            $comment->setArticle($blog);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);

            $entityManager->flush();
        }

        $comments = $em->getRepository(Comments::class)->findBy(
            array('article' => $id)
        );


//        foreach($comments as $comment){
//            print_r($comment->getUser()->getUsername());
//        }
//        exit;

        return $this->render('BlogBundle:Blog:article.html.twig', array(
            'blog'  => $blog,
            'form' => $form->createView(),
            'comments' => $comments
        ));
    }
}
