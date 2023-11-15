<?php

namespace App\Controller;

use App\Repository\ReviewsRepository;
use App\Form\ReviewType;
use App\Entity\Reviews;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ContactInfoRepository;
use App\Repository\UserRepository;
use App\Repository\WorkingHoursRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ReviewController extends AbstractController
{
    #[Route('/ajouter-avis', name: 'app_add_review')]
    public function add(
        ReviewsRepository $reviewsRepository,
        TokenStorageInterface $tokenStorage,
        Request $request,
        EntityManagerInterface $entityManager,
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository
    ): Response
    {
        $user = $tokenStorage->getToken()->getUser();
        $existingReview = $reviewsRepository->findOneBy(['user_mail' => $user]);
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();

        if ($existingReview) {
            $newReview = $existingReview;
        } else {
            $newReview = new Reviews();
        }

        $reviewForm = $this->createForm(ReviewType::class, $newReview);
        $reviewForm->handleRequest($request);
        if ($reviewForm->isSubmitted() && $reviewForm->isValid()) {
            $newReview->setUserMail($user);
            $newReview->setWasModerated(0);
            $entityManager->persist($newReview);
            $entityManager->flush();
            return $this->redirectToRoute('app_private_space');
        };
        

        return $this->render('add_review.html.twig', [
            'controller_name' => 'AddReviewController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'form' => $reviewForm -> createView(),
        ]);
    }

    #[Route('/moderation', name: 'app_edit_review')]
    public function edit(
        ReviewsRepository $reviewsRepository,
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository
    ): Response
    {
        
        $reviews = $reviewsRepository->findBy(['was_moderated' => 0]);
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();

        return $this->render('moderer_review.html.twig', [
            'controller_name' => 'AddReviewController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'reviews' => $reviews,
        ]);
    }

    #[Route('/approuver{id}', name: 'app_permit_review')]
    public function permit(
        $id,
        EntityManagerInterface $entityManager,
        ReviewsRepository $reviewsRepository,
    ): Response
    {
        
        $review = $reviewsRepository->find($id);

        if (!$review) {
            throw new NotFoundHttpException('Annonce not found'); 
        }

        $review->setWasModerated(1);
        $entityManager->persist($review);
        $entityManager->flush();
        
        return $this->redirectToRoute('app_edit_review');

    }

    #[Route('/supprimer-avis{id}', name: 'app_delete_review')]
    public function delete(
        $id,
        Request $request,
        EntityManagerInterface $entityManager,
        ReviewsRepository $reviewsRepository,
    ): Response
    {
        $review = $reviewsRepository->find($id);

        if (!$review) {
            throw new NotFoundHttpException('not found'); 
        }

        $review->setWasModerated(3);

        $entityManager->remove($review);
        $entityManager->flush();
        
        return $this->redirectToRoute('app_edit_review');
    }


    #[Route('/avis-list', name: 'app_show_reviews')]
    public function show(
        ReviewsRepository $reviewsRepository,
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository
    ): Response
    {
        
        $reviews = $reviewsRepository->findBy(['was_moderated' => 1]);
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();

        return $this->render('reviews.html.twig', [
            'controller_name' => 'AddReviewController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'reviews' => $reviews,
        ]);
    }
}
