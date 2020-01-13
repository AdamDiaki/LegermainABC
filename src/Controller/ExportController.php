<?php

namespace App\Controller;

use App\Entity\RequestProject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ExportController
 * @package App\Controller
 */
class ExportController extends Controller
{
    /**
     * @Route("/admin/devis/export", name="export")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function exportAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository( RequestProject::class );

        $id = $request->query->get( 'id' );
        $entity = $repository->find( $id );
        $entity->setTitle( 'Charpente' );

        $vCard = new \QRCode();
        $vCard->fullName( $entity->getUser()->getFirstname() . ' ' . $entity->getUser()->getName() );
        $vCard->email( $entity->getUser()->getEmail() );
        $vCard->workPhone( $entity->getUser()->getNumber() );
        $vCard->finish();


        return $this->render( '/export/index.html.twig', [
            'controller_name' => 'ExportController', 'vCard' => $vCard
        ] );

    }
}
