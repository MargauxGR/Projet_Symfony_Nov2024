<?php

namespace App\Controller;

use App\Entity\Outing;
use App\Form\OutingType;
use App\Repository\OutingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/outings', name: 'app_outings_')]
class OutingsController extends AbstractController
{
    #[Route('/', name: 'list', methods: ['GET'])]
    public function outings(OutingRepository $outingRepository): Response
    {
        $outings = $outingRepository->findAll();
        return $this->render('outings/outingsIndex.html.twig', [
            'outings' => $outings,
        ]);
    }

    //modifier le nom de le route et son url, le nom de méthode aussi
    #[Route(path: '/newouting', name: 'create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        /////////////////////////////////////////////
        //configurer le formulaire, dans une autre class qui termine _____type
        //utiliser une commnande pour ça
        /////////////////////////////////////


        //créer une instance du formulaire et l'associer avec une instance de outing vide
        //récupérer le requête HTTP pour récupérer les données du formulaire
        $outing = new Outing();
        $outingForm = $this->createForm(OutingType::class, $outing);
        $outingForm->handleRequest($request);

        //tester si le formulaire est soumis et si'il est valide
        if ($outingForm->isSubmitted() && $outingForm->isValid()) {
            //enregister la donnée
//            $outing->setPublished(true); ???
            $em->persist($outing);
            $em->flush();
            $this->addFlash('success', 'Your outing has been added.');
            return $this->redirectToRoute('app_outings_list');
        }

        //rediriger sur la page d'accueil

        //sinon renvoyer un nouveau template avec le code du formulaire
        return $this->render('outing_form/outingForm.html.twig', [
        "outingForm" => $outingForm
        ]);
    }

//    #[Route('/insert', name: 'insert')]
//    public function insert(Request $request): Response
//    {
//        $outingForm
//    }
}
