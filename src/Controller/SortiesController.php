<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortieType;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sorties', name: 'app_sorties_')]
class SortiesController extends AbstractController
{
    #[Route('/', name: 'liste', methods: ['GET'])]
    public function sorties(SortieRepository $sortieRepository): Response
    {
        $sorties = $sortieRepository->findAll();
        return $this->render('sorties/indsorties.html.twig', [
            'sorties' => $sorties,
        ]);
    }

    //modifier le nom de le route et son url, le nom de méthode aussi
    #[Route('/nouvelle_sortie', name: 'create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        /////////////////////////////////////////////
        //configurer le formulaire, dans une autre class qui termine _____type
        //utiliser une commnande pour ça
        /////////////////////////////////////


        //créer une instance du formulaire et l'associer avec une instance de sortie vide
        //récupérer le requête HTTP pour récupérer les données du formulaire
        $sortie = new Sortie();
        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $sortieForm->handleRequest($request);

        //tester si le formulaire est soumis et si'il est valide
        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {
            //enregister la donnée
//            $sortie->setPublished(true); ???
            $em->persist($sortie);
            $em->flush();
            $this->addFlash('success', 'Votre sortie a été ajoutée');
            return $this->redirectToRoute('app_sorties_liste');
        }

        //rediriger sur la page d'accueil

        //sinon renvoyer un nouveau template avec le code du formulaire
        return $this->render('sortie_form/sortieform.html.twig', [
        "sortieForm" => $sortieForm
        ]);
    }

//    #[Route('/insert', name: 'insert')]
//    public function insert(Request $request): Response
//    {
//        $sortieForm
//    }
}
