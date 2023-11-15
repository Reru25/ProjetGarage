<?php

namespace App\Controller;

use App\Repository\ContactRequestsRepository;
use App\Repository\ContactInfoRepository;
use App\Repository\ReviewsRepository;
use App\Repository\WorkingHoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrivateSpaceController extends AbstractController
{
    #[Route('/espace-personnel', name: 'app_private_space')]
    public function index(
        ReviewsRepository $reviewsRepository,
        ContactRequestsRepository $contactRequestsRepository,
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository
    ): Response
    {
        $reviews = $reviewsRepository->findBy(['was_moderated' => 0]);
        $contactRequests = $contactRequestsRepository->findAll();
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();

        return $this->render('private_space.html.twig', [
            'controller_name' => 'PrivateSpaceController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'contactReq' => $contactRequests,
            'reviews' => $reviews,
        ]);
    }
    
}
