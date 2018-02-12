<?php

namespace Bloggr\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ContactController extends Controller
{
    /**
     * @Route("/Contact", name="contact")
     */
    public function ContactAction()
    {
        return $this->render('BlogBundle:Contact:contact.html.twig', array(
            // ...
        ));
    }

}
