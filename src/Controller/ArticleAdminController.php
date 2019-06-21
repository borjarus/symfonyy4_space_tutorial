<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new")
     */
    public function new(EntityManagerInterface $em)
    {
        die('TODO');

        return new Response(sprintf('Hiya! New article id: #%d, slug: %s', $article->getId(), $article->getSlug()));
    }
}