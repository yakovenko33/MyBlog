<?php

namespace Bloggr\BlogBundle\Service;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use  Bloggr\BlogBundle\Entity\User;
use  Bloggr\BlogBundle\Entity\Role;
use Doctrine\ORM\EntityManager;

class UserService
{

   private $em;
   private $encoder;

   public function __construct(EntityManager $em, UserPasswordEncoder $encoder)
   {
       $this->em = $em;
       $this->encoder = $encoder;
   }

   public function coderPassword(User $user, Role $role)
   {
       $coderPassword = $this->encoder->encodePassword($user, $user->getPassword());
       $user->setPassword( $coderPassword);

       $role->setRole('ROLE_USER');
       $user->addRole($role);
       $this->em->persist($role);
       $this->em->persist($user);
       $this->em->flush();

       return $user;
   }

}