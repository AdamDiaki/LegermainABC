<?php


namespace App\Controller;


use App\Entity\Application;
use App\Entity\Offer;
use App\Entity\User;
use App\Form\ApplicationType;
use App\Form\OfferFormType;
use App\Repository\OfferRepository;
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
    public function Offer(OfferRepository $repository, Request $request) : Response
    {

        $application = new Application();
        $form = $this->createForm(OfferFormType::class);
        $formApplication = $this->createForm(ApplicationType::class, $application);
        $offres = $repository->findBy(['accepted' => false]);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            /*
            $data = $form->getData();
            $user = new User();
            $user->setName($data['name']);
            $user->setFirstname($data['firstname']);
            $user->setAddress($data['address']);
            $user->setNumber($data['number']);
            $user->setEmail($data['email']);
            */
            $user = $form->getData();
            $application = new Application();
            $application->setUser($user);
            $offer = $repository->findBy(['id' => $form->get('offerId')->getData()]);

            $application = new Application();
            $application->setUser($user);
            $application->setOffer($offer[0]);
            $application->setApplicationAt(new \DateTime());


            /** @var UploadedFile $cvFile */
            $cvFile = $form['cvFile']->getData();
            $cvDirectory = $this->getParameter('app.path.application_cv');
            $cvFileName = md5(uniqid()).'.'.$cvFile->guessExtension();
            $cvFile->move($cvDirectory, $cvFileName);
            $application->setLinkCV($cvDirectory.'/'.$cvFileName);

            /** @var UploadedFile $resumeFile */
            $resumeFile = $form['resumeFile']->getData();
            $resumeDirectory = $this->getParameter('app.path.application_resume');
            $resumeFileName = md5(uniqid().'.'.$resumeFile->guessExtension());
            $resumeFile->move($resumeDirectory, $resumeFileName);
            $application->setLinkResume($resumeDirectory.'/'.$resumeFileName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->persist($application);
            $entityManager->flush();

        }
/*
        $formApplication->handleRequest($request);
        if($formApplication->isSubmitted() && $formApplication->isValid())
        {
            $cvFile = $request->files->get('post')['cv'];
            echo "<pre>";
            var_dump($request);
            die;
            $application = $formApplication->getData();
            $cvFile = $formApplication['cvFile']->getData();
            $resumeFile = $formApplication['resumeFile']->getData();
            $cvFileName = md5(uniqid()).'.'.$cvFile->guessExtension();
            $cvFile->move($this->getParameter('app.path.application_cv'), $cvFileName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($application);
            $entityManager->flush();
        }
*/
        return $this->render('pages/offer.html.twig', [
            'offres' => $offres,
            'CandidateForm' => $form->createView(),
            'ApplicationForm' => $formApplication->createView()
        ]);
    }
}