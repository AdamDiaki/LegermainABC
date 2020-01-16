<?php

namespace App\Controller;

use App\Repository\ActualityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AccueilController
 * @package App\Controller
 */
class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(ActualityRepository $repository)
    {
        $actualites = $repository->findAll();

        return $this->render( 'accueil/accueil.html.twig', [
            'controller_name' => 'AccueilController',
            'actualites' => $actualites,
        ] );
    }
}
