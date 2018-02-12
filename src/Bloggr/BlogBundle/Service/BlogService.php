<?php
namespace Bloggr\BlogBundle\Service;

use Bloggr\BlogBundle\Entity\Blog;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;


class BlogService{


    private $em;
    private $passwordEncoder;

    public function __construct(EntityManager $em, UserPasswordEncoder $passwordEncoder)
    {
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function create(User $user)
    {

    }


}


