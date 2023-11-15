<?php

namespace App\Controller;

use App\Entity\ContactInfo;
use App\Form\ContactType;
use App\Entity\ContactRequests;
use App\Form\ContactInfoType;
use App\Repository\ContactInfoRepository;
use App\Repository\ContactRequestsRepository;
use App\Repository\WorkingHoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController 
{   
    #[Route('/contact-liste', name: 'app_list_contact')]
    public function show(
        ContactRequestsRepository $contactRequestsRepository,
        Request $request,
        EntityManagerInterface $entityManager,
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository
    ): Response
    {
        $contactRequests = $contactRequestsRepository->findAll();
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();


        return $this->render('contact_requests.html.twig', [
            'controller_name' => 'ContactController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'contactRequests' => $contactRequests,
        ]);
    }

    #[Route('/supprimer-demande{id}', name: 'app_delete_contact')]
    public function delete(
        $id,
        ContactRequestsRepository $contactRequestsRepository,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $contactRequest = $contactRequestsRepository->find($id);

        if (!$contactRequest) {
            throw new NotFoundHttpException('Annonce not found'); 
        }

        $entityManager->remove($contactRequest);
        $entityManager->flush();
        
        return $this->redirectToRoute('app_list_contact');
    }

    #[Route('/contact', name: 'app_contact')]
    public function add(
        Request $request,
        EntityManagerInterface $entityManager,
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository
    ): Response
    {
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();

        $newContactRequest = new ContactRequests();
        $contactForm = $this->createForm(ContactType::class, $newContactRequest);
        $contactForm->handleRequest($request);
        if($contactForm->isSubmitted() && $contactForm->isValid()) {
            $entityManager->persist($newContactRequest);
            $entityManager->flush();
            return $this->redirectToRoute('app_contact');
        }

        
        return $this->render('contact.html.twig', [
            'controller_name' => 'ContactController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'form' => $contactForm ->createView()
        ]);
    }

    #[Route('/contact-edit', name: 'app_edit_contact')]
    public function edit(
        Request $request,
        WorkingHoursRepository $workingHoursRepository,
        EntityManagerInterface $entityManager,
        ContactInfoRepository $contactInfoRepository,
    ): Response
    {
        $schedule = $workingHoursRepository->findAll();
        $contactInfo = $contactInfoRepository->findAll();

        if ($contactInfo[0]) {
            $newContactInfo = $contactInfo[0];
        } else {
            $newContactInfo = new ContactInfo();
        }

        $contactInfoForm = $this->createForm(ContactInfoType::class, $newContactInfo);
        $contactInfoForm->handleRequest($request);
        if ($contactInfoForm->isSubmitted() && $contactInfoForm->isValid()) {
            $entityManager->persist($newContactInfo);
            $entityManager->flush();
            return $this->redirectToRoute('app_private_space');
        };

        return $this->render('Edit_contact_info.html.twig', [
            'controller_name' => 'ContactController',
            'shedule' => $schedule[0],
            'contact' => $contactInfo[0],
            'form' => $contactInfoForm ->createView()
        ]);
    }
}
