<?php

namespace  Bloggr\BlogBundle\Form;

use Bloggr\BlogBundle\Entity\Blog;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',TextType::class)
            ->add('author',TextType::class)
            ->add('blog',TextareaType::class)
            ->add('image',TextType::class)
            ->add('tags',TextType::class)
            ->add('created',DateType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }


    public function getBlockPrefix()
    {
        return 'bloggr_blogbundle_user';
    }
}