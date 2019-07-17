<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\ArticleFormType;

/**
 * @IsGranted("ROLE_ADMIN_ARTICLE")
 */
class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/article/new", name="app_article_new")
     */
    public function new(EntityManagerInterface $em)
    {
        $form = $this->createForm(ArticleFormType::class);

        return $this->render('article_admin/new.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/article/{id}/edit", name="app_article_edit")
     * IsGranted("MENAGE", subject="article")
     */
    public function edit(Article $article)
    {
        $this->denyAccessUnlessGranted('MENAGE', $article);
        dd($article);
    }
}