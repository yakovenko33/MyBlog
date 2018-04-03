<?php

namespace Bloggr\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AboutController extends Controller
{
    /**
     * @Route("/About", name="about")
     */
    public function aboutAction()
    {
        return $this->render('BlogBundle:About:about.html.twig', array(
            // ...
        ));
    }

}
