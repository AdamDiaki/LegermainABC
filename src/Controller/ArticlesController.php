<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/charpente", name="charpente")
     */
    public function charpente(ArticleRepository $repo)
    {
        $articles = $repo->findBy(['category' => 3]);
        return $this->render( 'articles/charpente.html.twig', [
            'controller_name' => 'ArticlesController',  'articles' =>$articles
        ] );
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
