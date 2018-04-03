<?php

namespace Bloggr\BlogBundle\Controller;

use Bloggr\BlogBundle\Service;
use Bloggr\BlogBundle\Service\BlogService;
use Bloggr\BlogBundle\Entity\Blog;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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
    public function articleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository(Blog::class)->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $this->render('BlogBundle:Blog:article.html.twig', array( 'blog'  => $blog,
            // ...
        ));
    }
}
