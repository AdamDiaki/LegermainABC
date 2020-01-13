<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\BackgroundImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ArticlesController
 * @package App\Controller
 */
class ArticlesController extends AbstractController
{
    /**
     * Cette fonction permet d'accéder aux articles sur la chaprente
     * @Route("/charpente", name="charpente")
     */
    public function charpente(BackgroundImageRepository $image, ArticleRepository $repo)
    {

        $images = $image->findBy( array('category' => 1), array('id' => 'DESC'), 3 );
        $articles = $repo->findBy( ['category' => 1], array('id' => 'DESC') );


        return $this->render( 'articles/charpente.html.twig', [
            'controller_name' => 'ArticlesController', 'articles' => $articles, 'images' => $images
        ] );
    }

    /**
     * @Route("/couverture", name="couverture")
     */
    public function couverture(BackgroundImageRepository $image, ArticleRepository $repo)
    {
        $images = $image->findBy( array('category' => 2), array('id' => 'DESC'), 3 );
        $articles = $repo->findBy( array('category' => 2), array('id' => 'DESC') );
        return $this->render( 'articles/couverture.html.twig', [
            'controller_name' => 'ArticlesController', 'articles' => $articles, 'images' => $images
        ] );
    }

    /**
     * @Route("/ouvrageSpecifique", name="ouvrage")
     */
    public function ouvrage(BackgroundImageRepository $image, ArticleRepository $repo)
    {
        $images = $image->findBy( array('category' => 3), array('id' => 'DESC'), 3 );
        $articles = $repo->findBy( ['category' => 3], array('id' => 'DESC') );
        return $this->render( 'articles/ouvrage.html.twig', [
            'controller_name' => 'ArticlesController', 'articles' => $articles, 'images' => $images
        ] );
    }


    /**
     * @Route("/article{id}",name="article_show")
     *
     */
    public function show(Article $article)
    {

        return $this->render( 'articles/article_show.html.twig', ['controller_name' => 'ArticlesController', 'article' => $article

        ] );
    }

}
