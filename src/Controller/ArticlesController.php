<?php

namespace App\Controller;

use App\Entity\Article;

use App\Repository\ArticleImagesRepository;
use App\Repository\ArticleRepository;
use App\Repository\ImageRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;


class ArticlesController extends AbstractController
{
    /**
     * @Route("/charpente", name="charpente")
     */
    public function charpente(ArticleRepository $repo,ImageRepository $repo1, ArticleImagesRepository $repo2)
    {
        $articles = $repo->findBy(['category' => 1]);

        return $this->render( 'articles/charpente.html.twig', [
            'controller_name' => 'ArticlesController',  'articles' =>$articles,
        ] );
    }

    /**
     * @Route("/charpente{id}",name="charpente_show")
     *
     */
    public function show(Article $article){
        return $this->render('articles/charpente_show.html.twig',['controller_name' => 'ArticlesController','article' => $article

        ]);
    }
    /**
     * @Route("/couverture", name="couverture")
     */
    public function couverture(ArticleRepository $repo)
    {
        $articles = $repo->findBy(array('category'=>'Couverture'));
        return $this->render( 'articles/couverture.html.twig', [
            'controller_name' => 'ArticlesController', 'articles' =>$articles
        ] );
    }
    /**
     * @Route("/ouvrageSpecifique", name="ouvrage")
     */
    public function ouvrage(ArticleRepository $repo)
    {
        $articles = $repo->findBy(array('category'=>'Ouvrages spécifiques'));
        return $this->render( 'articles/ouvrage.html.twig', [
            'controller_name' => 'ArticlesController', 'articles' =>$articles
        ] );
    }

}
