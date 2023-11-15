<?php

namespace App\Controller;

use App\Entity\WorkingHours;
use App\Form\HoursType;
use App\Repository\ContactInfoRepository;
use App\Repository\WorkingHoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HoursController extends AbstractController
{
    #[Route('hours', name: 'app_hours')]
    public function show(
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository
        ): Response
    {

        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();

        return $this->render('hours.html.twig', [
            'shedule' => $schedule[0],
            'contact' => $contact[0],
        ]);
    }

    #[Route('hours-edit', name: 'app_edit_hours')]
    public function edit(
        Request $request,
        EntityManagerInterface $entityManager,
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository
        ): Response
    {

        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();
        $existingHours = $workingHoursRepository->findAll();
        $existingHours = $existingHours[0];
        
        if ($existingHours) {
            $newHours = $existingHours;
        } else {
            $newHours = new WorkingHours();
        }

        $hoursForm = $this->createForm(HoursType::class, $newHours);
        $hoursForm->handleRequest($request);
        if ($hoursForm->isSubmitted() && $hoursForm->isValid()) {
            $entityManager->persist($newHours);
            $entityManager->flush();
            return $this->redirectToRoute('app_private_space');
        };

        return $this->render('edit_hours.html.twig', [
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'form' => $hoursForm -> createView(),
        ]);
    }
}
