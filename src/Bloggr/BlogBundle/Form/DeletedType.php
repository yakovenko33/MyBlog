<?php

namespace  Bloggr\BlogBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

class DeletedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }


    public function getBlockPrefix()
    {
        return 'bloggr_blogbundle_user';
    }
}