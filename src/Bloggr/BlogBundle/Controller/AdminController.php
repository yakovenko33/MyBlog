<?php

namespace Bloggr\BlogBundle\Controller;

use  Bloggr\BlogBundle\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bloggr\BlogBundle\Form\AdminType;
use Bloggr\BlogBundle\Form\DeletedType;
use Bloggr\BlogBundle\Form\EditType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormError;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction(Request $request)
    {
        return $this->render('BlogBundle:Admin:main.html.twig', array());
    }

    /**
     * @Route("/admin/add_news", name="admin_add_news")
     */

    public function addNewsAction(Request $request)
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

        return $this->render('BlogBundle:Admin:addnews.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/deleted", name="admin_deleted")
     */
    public function deletedAction(Request $request)
    {
        $blog = new Blog;

        $formDeleted = $this->createForm(DeletedType::class, $blog);
        $formDeleted->handleRequest($request);

        if ($formDeleted->isSubmitted() && $formDeleted->isValid()) {
            $formDeleted->getData();

            /*$entityManager = $this->getDoctrine()->getManager();
            $checkBlog = $entityManager->getRepository(Blog::class)->findOneBy(array('title' => $blog->getTitle()));*/

            $repository = $this->getDoctrine()->getRepository(Blog::class);
            $checkBlog = $repository->findOneBy(array('title' => $blog->getTitle()));

            $em = $this->getDoctrine()->getManager();
            $em->remove($checkBlog);
            $em->flush();

        }

        return $this->render('BlogBundle:Admin:deleted.html.twig', array(
            'form' => $formDeleted->createView(),
        ));
    }

    /**
     * @Route("/admin/search", name="admin_edit")
     */
    public function searchAction(Request $request)
    {
        $blog = new Blog;

        $formSearch =  $form = $this->createFormBuilder($blog)
            ->add('title', TextType::class)->getForm();

        $formSearch->handleRequest($request);

            if ($formSearch->isSubmitted() && $formSearch->isValid()) {
                $formSearch->getData();

                $repository = $this->getDoctrine()->getRepository(Blog::class);
                $checkBlog = $repository->findOneBy(array('title' => $blog->getTitle()));

                if(is_null($checkBlog)) {
                    $formSearch->addError(new FormError('Blog entry does not exists'));
                    return $this->render('BlogBundle:Admin:search.html.twig', array(
                        'form' => $formSearch->createView(),
                    ));
                }

                $url = $this->generateUrl('edit_step', ['blogId' =>  $checkBlog->getId()]);
                return $this->redirect($url);
            }

        return $this->render('BlogBundle:Admin:search.html.twig', array(
            'form' => $formSearch->createView(),
        ));
    }

    /**
     *  @Route("/admin/edit/{blogId}", name="edit_step")
     */
    public function editAction(Request $request, $blogId)
    {
        $blog = new Blog;
        $blogId = (int)$blogId;

        $repository = $this->getDoctrine()->getRepository(Blog::class);
        $article = $repository->find($blogId);

        $formEdit = $this->createForm(EditType::class, $article);
        $formEdit->handleRequest($request);

        if ($formEdit->isSubmitted() && $formEdit->isValid()) {
             $formEdit->getData();



            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
        }

        return $this->render('BlogBundle:Admin:edit.html.twig', array(
            'form' => $formEdit->createView(),
            'blogId' => $blogId
        ));
    }

}
