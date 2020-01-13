<?php


namespace App\Controller;


use App\Entity\Application;
use App\Form\OfferFormType;
use App\Repository\OfferRepository;
use App\Repository\UserRepository;
use ReCaptcha\ReCaptcha;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class OfferController
 * @package App\Controller
 */
class OfferController extends AbstractController
{


    /**
     * @Route("/offre",name="offre")
     * @param OfferRepository $repository
     * @return Response
     */
    public function Offer(OfferRepository $repository, Request $request, UserRepository $userRepository): Response
    {

        $application = new Application();
        $form = $this->createForm( OfferFormType::class );
        // On récupère les offres qui sont toujours d'actualité
        $offres = $repository->findBy( ['accepted' => false] );
        $form->handleRequest( $request );
        $recaptcha = new ReCaptcha( '6LfO380UAAAAADzUkyS7iWRBKtcfiSLRQl9YnMCa' );
        $resp = $recaptcha->verify( $request->request->get( 'g-recaptcha-response' ), $request->getClientIp() );


        if ($form->isSubmitted() && $form->isValid()) {
            if (!$resp->isSuccess()) {
                $this->addFlash( 'fileFormat', "Problème au niveau du captcha veuillez rééssayer" );
                return $this->redirectToRoute( 'offre' );
            } else {
                /** @var UploadedFile $cvFile
                 *On récupère le CV
                 */
                $cvFile = $form['cvFile']->getData();
                /** @var UploadedFile $resumeFile
                 *On récupère la lettre de motivation
                 */
                $resumeFile = $form['resumeFile']->getData();
                //On vérifie si ce sont des pdf
                if ($cvFile->guessExtension() == "pdf" || $resumeFile->guessExtension() == "pdf") {
                    $entityManager = $this->getDoctrine()->getManager();
                    // On vérifie si l'utilisateur est déjà inscrit dans la base de donnée
                    $userexist = $userRepository->findBy( ['email' => $form->get( 'email' )->getData()] );
                    $application = new Application();
                    if ($userexist == null) {
                        $user = $form->getData();
                        $application->setUser( $user );
                        $entityManager->persist( $user );
                    } else {
                        $application->setUser( $userexist[0] );
                    }

                    // On récupère la bonne offre
                    $offer = $repository->findBy( ['id' => $form->get( 'offerId' )->getData()] );

                    $application->setOffer( $offer[0] );
                    $application->setApplicationAt( new \DateTime() );

                    // On va modiifer le nom des fichiers et les upload dans le bon dossier inscrit dans le service.yaml
                    $cvDirectory = $this->getParameter( 'app.path.application_cv' );
                    $cvFileName = md5( uniqid() ) . '.' . $cvFile->guessExtension();
                    $cvFile->move( $cvDirectory, $cvFileName );
                    $application->setLinkCV( $cvFileName );

                    $resumeDirectory = $this->getParameter( 'app.path.application_resume' );
                    $resumeFileName = md5( uniqid() ) . '.' . $resumeFile->guessExtension();
                    $resumeFile->move( $resumeDirectory, $resumeFileName );
                    $application->setLinkResume( $resumeFileName );

                    $entityManager->persist( $application );
                    $entityManager->flush();
                    $this->addFlash( 'fileFormat', "Votre candidature a bien été pris en compte" );
                    return $this->redirectToRoute( 'offre' );

                } else {
                    // Si le format des fichiers n'est pas bon, on renvoie un message d'erreur
                    $this->addFlash( 'fileFormat', "Candidature non pris en compte car vos fichiers ne sont pas au format pdf" );
                    return $this->redirectToRoute( 'offre' );
                }

            }
        }

        return $this->render( 'pages/offer.html.twig', [
            'offres' => $offres,
            'CandidateForm' => $form->createView()
        ] );
    }

}