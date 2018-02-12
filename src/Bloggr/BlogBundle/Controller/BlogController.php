<?php

namespace Bloggr\BlogBundle\Controller;

use Bloggr\BlogBundle\Service;
use Bloggr\BlogBundle\Service\BlogService;
use Bloggr\BlogBundle\Entity\Blog;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BlogController extends Controller
{
    /**
     * @Route("/Blog", name="blog")
     */
    public function AboutAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Blog::class);

        $blogs = $repository->createQueryBuilder('b')
            ->addOrderBy('b.created', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->render('BlogBundle:Blog:blog.html.twig', array( 'blogs' => $blogs

        ));
    }

    /**
     *
     * @Route("/Blog/{id}", name="article")
     */
    public function ArticleAction($id)
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
