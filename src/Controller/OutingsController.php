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

    #[Route(path: '/outing', name: 'create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $outing = new Outing();
        $outingForm = $this->createForm(OutingType::class, $outing);
        $outingForm->handleRequest($request);

        if ($outingForm->isSubmitted() && $outingForm->isValid()) {
            $em->persist($outing);
            $em->flush();
            $this->addFlash('success', 'Your outing has been added.');
            return $this->redirectToRoute('app_outings_list');
        }

        return $this->render('form/outingForm.html.twig', [
        "outingForm" => $outingForm
        ]);
    }
}
