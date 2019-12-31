<?php


namespace App\Controller;


use App\Form\ApplicationType;
use App\Form\OfferFormType;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class OfferController extends AbstractController
{


    /**
     * @Route("/offre",name="offre")
     * @param OfferRepository $repository
     * @return Response
     */
    public function Offer(OfferRepository $repository, Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createForm( OfferFormType::class );
        $formApplication = $this->createForm( ApplicationType::class );
        $offres = $repository->findBy( ['accepted' => false] );


        return $this->render( 'pages/offer.html.twig', [
            'offres' => $offres,
            'CandidateForm' => $form->createView(),
            'ApplicationForm' => $formApplication->createView()
        ] );
    }
}