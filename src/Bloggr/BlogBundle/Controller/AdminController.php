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

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function AdminAction(Request $request)
    {

        return $this->render('BlogBundle:Admin:main.html.twig', array(

        ));
    }

    /**
     * @Route("/admin/add_news", name="admin_add_news")
     */

    public function AddNewsAction(Request $request)
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
    public function DeletedAction(Request $request)
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
     * @Route("/admin/edit", name="admin_edit")
     */
    public function SearchAction(Request $request)
    {

        $blog = new Blog;

        $formSerch = $this->createForm(EditType::class, $blog);
        $formSerch->handleRequest($request);




            if ($formSerch->isSubmitted() && $formSerch->isValid()) {
                $formSerch->getData();



                /*$repository = $this->getDoctrine()->getRepository(Blog::class);
                        $checkBlog = $repository->findOneBy(array('title' => $blog->getTitle()));

                        $formEdit = $form = $this->createFormBuilder($blog)
                            ->add('title',TextType::class, array(
                                'data' => $checkBlog->getTitle(),
                            ))
                            ->add('author',TextType::class, array(
                                'data' => $checkBlog->getAuthor(),
                            ))
                            ->add('blog',TextareaType::class, array(
                                'data' => $checkBlog->getBlog(),
                            ))
                            ->add('image',TextType::class, array(
                                'data' => $checkBlog->getImage(),
                            ))
                            ->add('tags',TextType::class, array(
                                'data' => $checkBlog->getTags(),
                            ))->getForm();

                        $formEdit->handleRequest($request);

                        if ($formEdit->isSubmitted() &&  $formEdit->isValid()) {
                            $formEdit->getData();

                            $em = $this->getDoctrine()->getManager();
                            $em->remove($checkBlog);
                            $em->flush();
                        }*/

                /*return $this->render('BlogBundle:Admin:edit.html.twig', array(
                    'form' => $formEdit->createView(),
                ));*/

            }

        $post_data = $request->get('title' );



            if(!is_null($blog->getTitle())){
                $repository = $this->getDoctrine()->getRepository(Blog::class);
                $checkBlog = $repository->findOneBy(array('title' => $blog->getTitle()));

                $formEdit = $form = $this->createFormBuilder($blog)
                    ->add('title',TextType::class, array(
                        'data' => $checkBlog->getTitle(),
                    ))
                    ->add('author',TextType::class, array(
                        'data' => $checkBlog->getAuthor(),
                    ))
                    ->add('blog',TextareaType::class, array(
                        'data' => $checkBlog->getBlog(),
                    ))
                    ->add('image',TextType::class, array(
                        'data' => $checkBlog->getImage(),
                    ))
                    ->add('tags',TextType::class, array(
                        'data' => $checkBlog->getTags(),
                    ))->getForm();

                $formEdit->handleRequest($request);

                if ($formEdit->isSubmitted() &&  $formEdit->isValid()) {
                    $formEdit->getData();

                    $em = $this->getDoctrine()->getManager();
                    $em->remove($checkBlog);
                    $em->flush();
                }

                return $this->render('BlogBundle:Admin:edit.html.twig', array(
                    'form' => $formEdit->createView(),
                ));
            }




        return $this->render('BlogBundle:Admin:search.html.twig', array(
            'form' => $formSerch->createView(),
        ));
    }

}
