<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */

    public function blog()
    {
        return $this->render('blog/blog.html.twig', [
    }

    /**
     * @Route("/blog/12", name="blog_show")
     */
    public function articles(){
        return $this->render('blog/articles.html.twig');
    }
}
