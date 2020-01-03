<?php


namespace App\Controller;


use App\Entity\Application;
use App\Entity\Offer;
use App\Entity\User;
use App\Form\ApplicationType;
use App\Form\OfferFormType;
use App\Repository\OfferRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class OfferController extends AbstractController
{


    /**
     * @Route("/offre",name="offre")
     * @param OfferRepository $repository
     * @return Response
     */
    public function Offer(OfferRepository $repository, Request $request, UserRepository $userRepository) : Response
    {

        $application = new Application();
        $form = $this->createForm(OfferFormType::class);
        $formApplication = $this->createForm(ApplicationType::class, $application);
        $offres = $repository->findBy(['accepted' => false]);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            /** @var UploadedFile $cvFile */
            $cvFile = $form['cvFile']->getData();
            /** @var UploadedFile $resumeFile */
            $resumeFile = $form['resumeFile']->getData();
            if($cvFile->guessExtension() == "pdf" || $resumeFile->guessExtension() == "pdf" )
            {
                $entityManager = $this->getDoctrine()->getManager();
                $userexist = $userRepository->findBy(['email' => $form->get('email')->getData()]);
                $application = new Application();
                if($userexist == null){
                    $user = $form->getData();
                    $application->setUser($user);
                    $entityManager->persist($user);
                } else{
                    $application->setUser($userexist[0]);
                }

                $offer = $repository->findBy(['id' => $form->get('offerId')->getData()]);

                $application->setOffer($offer[0]);
                $application->setApplicationAt(new \DateTime());

                $cvDirectory = $this->getParameter('app.path.application_cv');
                $cvFileName = md5(uniqid()).'.'.$cvFile->guessExtension();
                $cvFile->move($cvDirectory, $cvFileName);
                $application->setLinkCV($cvDirectory.'/'.$cvFileName);

                $resumeDirectory = $this->getParameter('app.path.application_resume');
                $resumeFileName = md5(uniqid()).'.'.$resumeFile->guessExtension();
                $resumeFile->move($resumeDirectory, $resumeFileName);
                $application->setLinkResume($resumeDirectory.'/'.$resumeFileName);

                $entityManager->persist($application);
                $entityManager->flush();
            } else{
                $this->addFlash('failed', "Candidature non pris en compte car vos fichiers ne sont pas au format pdf");

            }


        }

        return $this->render('pages/offer.html.twig', [
            'offres' => $offres,
            'CandidateForm' => $form->createView(),
            'ApplicationForm' => $formApplication->createView()
        ]);
    }
}