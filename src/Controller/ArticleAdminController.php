<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new", name="app_article_new")
     */
    public function new(EntityManagerInterface $em)
    {
        die('TODO');

        return new Response(sprintf('Hiya! New article id: #%d, slug: %s', $article->getId(), $article->getSlug()));
    }
}