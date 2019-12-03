<?php


namespace App\Controller;


use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class OfferController extends AbstractController
{


    /**
     * @Route("/Offre",name="offre")
     * @param OfferRepository $repository
     * @return Response
     */
    public function Offer(OfferRepository $repository): Response
    {
        $offres = $repository->findAllNt();
        return $this->render('pages/offer.html.twig', [
            'offres' => $offres
        ]);
    }
}