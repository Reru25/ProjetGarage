<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\ReviewsRepository;
use App\Repository\ContactInfoRepository;
use App\Repository\AnnonceRepository;
use App\Repository\ServicesRepository;
use App\Repository\WorkingHoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('', name: 'app_index')]
    public function index(
        UserRepository $userRepository,
        ReviewsRepository $reviewsRepository,
        ServicesRepository $servicesRepository,
        ContactInfoRepository $contactInfoRepository,
        AnnonceRepository $annonceRepository,
        WorkingHoursRepository $workingHoursRepository
        ): Response
    {   
        $users = $userRepository->findAll();
        $avisList = $reviewsRepository->findAll();
        $schedule = $workingHoursRepository->findAll();
        $annonces = $annonceRepository->findAll();
        $contact = $contactInfoRepository->findAll();
        $prestations = $servicesRepository->findAll();

        $average = 0;

        //check if any review exists
        if(count($avisList) > 0) {
            foreach( $avisList as $avis ) {
                $average = $average + $avis->getGrade();
             }
     
             $average = round($average/count($avisList));
        }

        return $this->render('index.html.twig', [
            'controller_name' => 'IndexController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'prestations' => $prestations,
            'annonces' => $annonces,
            'avisList' => $avisList,
            'average' => $average,
        ]);
    }
}
