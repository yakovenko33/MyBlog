<?php

namespace Bloggr\BlogBundle\Controller;

use Bloggr\BlogBundle\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class TestController extends Controller
{
    /**
     * @Route("test")
     */
    public function testAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Blog::class);

        $blogs = $repository->createQueryBuilder('b')
            ->addOrderBy('b.created', 'DESC')
            ->getQuery()
            ->getResult();

        print_r($blogs);
        exit;

        return $this->render('BlogBundle:Test:test.html.twig', array(
            // ...
        ));
    }

}
