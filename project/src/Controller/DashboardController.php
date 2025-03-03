<?php

namespace App\Controller;

use App\Entity\Timetable;
use App\Form\TimetableFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class DashboardController extends AbstractController
{
    #[IsGranted("ROLE_USER")]
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(EntityManagerInterface $entity_manager): Response
    {

        $repository = $entity_manager->getRepository(Timetable::class);

        $timetables = $repository->findAll();

        return $this->render('dashboard/index.html.twig', [
            'timetables' => $timetables,
        ]);
    }

    #[IsGranted("ROLE_USER")]
    #[Route('/dashboard/add-timetable', name: 'app_add_timetable')]
    public function addTimetable(Request $request, EntityManagerInterface $entity_manager): Response
    {
        $timetable = new Timetable();

        $form = $this->createForm(TimetableFormType::class, $timetable);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $timetable = $form->getData();
            $entity_manager->persist($timetable);
            $entity_manager->flush();
            $this->addFlash('success', 'L\'emploi du temps a été envoyé !');
            return $this->redirectToRoute('app_dashboard');
        }
        return $this->render('dashboard/add_timetable.html.twig', [
            'TimetableForm' => $form->createView(),
        ]);
    }
}
