<?php

namespace App\Controller;

use App\Entity\ContactRequests;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Repository\AnnonceRepository;
use App\Entity\Annonce;
use App\Form\AnnouncmentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ContactInfoRepository;
use App\Repository\WorkingHoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnouncmentsController extends AbstractController
{   
    #[Route('/announcements', name: 'app_announcements')]
    public function show(
        ContactInfoRepository $contactInfoRepository,
        AnnonceRepository $annonceRepository,
        WorkingHoursRepository $workingHoursRepository
        ): Response
    {   
        $annonces = $annonceRepository->findAll();
        $annoncesJSON = json_encode($annonces);
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();

        return $this->render('annoncements.html.twig', [
            'controller_name' => 'AnnouncementsController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'annonces' => $annonces,
            'annoncesJSON' => $annoncesJSON,
        ]);
    }

    #[Route('/annoncement{id}', name: 'app_annoncement')]
    public function showSpecific(
        $id,
        Request $request,
        EntityManagerInterface $entityManager,
        ContactInfoRepository $contactInfoRepository, 
        AnnonceRepository $annonceRepository,
        WorkingHoursRepository $workingHoursRepository 
        ): Response
    {
        $annonce = $annonceRepository->find($id);

        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();
        $requestConfirm = false;

        $newContactRequest = new ContactRequests();
        $contactForm = $this->createForm(ContactType::class, $newContactRequest);
        $contactForm->handleRequest($request);
        if($contactForm->isSubmitted() && $contactForm->isValid()) {
            $newContactRequest->setSubject($annonce->getBrand() ." ". $annonce->getModel() . " ( " . $request->getUri() . " ).");
            $entityManager->persist($newContactRequest);
            $entityManager->flush();
            $requestConfirm = true;
        }

        return $this->render('annoncement.html.twig', [
            'controller_name' => 'AnnoncementController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'annonceId' => $id,
            'annonce' => $annonce,
            'form' => $contactForm ->createView(),
            'requestConfirm' => $requestConfirm,
        ]);
    }
    
    #[Route('/ajouter-annonce', name: 'app_add_announcment')]
    public function add(
        Request $request,
        EntityManagerInterface $entityManager,
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository,
    ): Response
    {
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();
        $uploadDirectory = __DIR__ . '/../../public_html/sources/annonces';

        $announcement = new Annonce();
        $AnnouncmentForm = $this->createForm(AnnouncmentType::class, $announcement);
        $AnnouncmentForm->handleRequest($request);
        if($AnnouncmentForm->isSubmitted() && $AnnouncmentForm->isValid()) {

            $newAnnouncement = $AnnouncmentForm->getData();

            $imagePath1 = $AnnouncmentForm->get('imgPath1')->getData();
            if($imagePath1){
                $newFileName = uniqid() . '.'. $imagePath1->guessExtension();

                $imagePath1->move(
                    $this->getParameter('kernel.project_dir') . '/public_html/sources/annonces',
                    $newFileName
                );

                $newAnnouncement->setImgPath1('/sources/annonces/'. $newFileName);
            }

            $imagePath2 = $AnnouncmentForm->get('imgPath2')->getData();
            if($imagePath2){
                $newFileName = uniqid() . '.'. $imagePath2->guessExtension();

                $imagePath2->move(
                    $this->getParameter('kernel.project_dir') . '/public_html/sources/annonces',
                    $newFileName
                );

                $newAnnouncement->setImgPath2('/sources/annonces/'. $newFileName);
            }

            $imagePath3 = $AnnouncmentForm->get('imgPath3')->getData();
            if($imagePath3){
                $newFileName = uniqid() . '.'. $imagePath3->guessExtension();

                $imagePath3->move(
                    $this->getParameter('kernel.project_dir') . '/public_html/sources/annonces',
                    $newFileName
                );

                $newAnnouncement->setImgPath3('/sources/annonces/'. $newFileName);
            }

            $imagePath4 = $AnnouncmentForm->get('imgPath4')->getData();
            if($imagePath4){
                $newFileName = uniqid() . '.'. $imagePath4->guessExtension();

                $imagePath4->move(
                    $this->getParameter('kernel.project_dir') . '/public_html/sources/annonces',
                    $newFileName
                );

                $newAnnouncement->setImgPath4('/sources/annonces/'. $newFileName);
            }

            $imagePath5 = $AnnouncmentForm->get('imgPath5')->getData();
            if($imagePath5){
                $newFileName = uniqid() . '.'. $imagePath5->guessExtension();

                $imagePath5->move(
                    $this->getParameter('kernel.project_dir') . '/public_html/sources/annonces',
                    $newFileName
                );

                $newAnnouncement->setImgPath5('/sources/annonces/'. $newFileName);
            }

            $entityManager->persist($announcement);
            $entityManager->flush();

            return $this->redirectToRoute('app_private_space');
        }


        return $this->render('add_Announcment.html.twig', [
            'controller_name' => 'AddReviewController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'form' => $AnnouncmentForm ->createView()
        ]);
    }

    #[Route('/modifier-annonce{id}', name: 'app_edit_announcment')]
    public function edit(
        $id,
        Request $request,
        AnnonceRepository $annonceRepository,
        EntityManagerInterface $entityManager,
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository,
    ): Response
    {
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();
        $uploadDirectory = __DIR__ . '/../../public_html/sources/annonces';
        $existingAnnouncement = $annonceRepository->find($id);

        $announcement = $existingAnnouncement;
        $announcement->setImgPath1('null');
        $announcement->setImgPath2('null');
        $announcement->setImgPath3('null');
        $announcement->setImgPath4('null');
        $announcement->setImgPath5('null');
        $AnnouncmentForm = $this->createForm(AnnouncmentType::class, $announcement);
        $AnnouncmentForm->handleRequest($request);
        if($AnnouncmentForm->isSubmitted() && $AnnouncmentForm->isValid()) {

            $newAnnouncement = $AnnouncmentForm->getData();

            $imagePath1 = $AnnouncmentForm->get('imgPath1')->getData();
            if($imagePath1){
                $newFileName = uniqid() . '.'. $imagePath1->guessExtension();

                $imagePath1->move(
                    $this->getParameter('kernel.project_dir') . '/public_html/sources/annonces',
                    $newFileName
                );

                $newAnnouncement->setImgPath1('/sources/annonces/'. $newFileName);
            }

            $imagePath2 = $AnnouncmentForm->get('imgPath2')->getData();
            if($imagePath2){
                $newFileName = uniqid() . '.'. $imagePath2->guessExtension();

                $imagePath2->move(
                    $this->getParameter('kernel.project_dir') . '/public_html/sources/annonces',
                    $newFileName
                );

                $newAnnouncement->setImgPath2('/sources/annonces/'. $newFileName);
            }

            $imagePath3 = $AnnouncmentForm->get('imgPath3')->getData();
            if($imagePath3){
                $newFileName = uniqid() . '.'. $imagePath3->guessExtension();

                $imagePath3->move(
                    $this->getParameter('kernel.project_dir') . '/public_html/sources/annonces',
                    $newFileName
                );

                $newAnnouncement->setImgPath3('/sources/annonces/'. $newFileName);
            }

            $imagePath4 = $AnnouncmentForm->get('imgPath4')->getData();
            if($imagePath4){
                $newFileName = uniqid() . '.'. $imagePath4->guessExtension();

                $imagePath4->move(
                    $this->getParameter('kernel.project_dir') . '/public_html/sources/annonces',
                    $newFileName
                );

                $newAnnouncement->setImgPath4('/sources/annonces/'. $newFileName);
            }

            $imagePath5 = $AnnouncmentForm->get('imgPath5')->getData();
            if($imagePath5){
                $newFileName = uniqid() . '.'. $imagePath5->guessExtension();

                $imagePath5->move(
                    $this->getParameter('kernel.project_dir') . '/public_html/sources/annonces',
                    $newFileName
                );

                $newAnnouncement->setImgPath5('/sources/annonces/'. $newFileName);
            }

            $entityManager->persist($announcement);
            $entityManager->flush();

            return $this->redirectToRoute('app_private_space');
        }


        return $this->render('edit_Announcment.html.twig', [
            'controller_name' => 'AddReviewController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'form' => $AnnouncmentForm ->createView()
        ]);
    }

    #[Route('/supprimer-annonce{id}', name: 'app_delete_announcment')]
    public function delete(
        $id,
        Request $request,
        Filesystem $filesystem,
        EntityManagerInterface $entityManager,
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository,
        AnnonceRepository $annonceRepository,
    ) : Response
    {
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();

        $annonce = $annonceRepository->find($id);

        if (!$annonce) {
            throw new NotFoundHttpException('Annonce not found'); 
        }

        //remove the image1 if directory exists
        $imgPath1 = $annonce->getImgPath1();
        if($imgPath1 !== null && $imgPath1 !== '') {
            $imgPath1 = str_replace('/','\\', $imgPath1);//normalizing forward slashes to backslashes
            $projectDir = $this->getParameter('kernel.project_dir');

            $filesystem->remove($projectDir . '\public_html' . $imgPath1);//removing file at directory
        }

        //remove the image2 if directory exists
        $imgPath2 = $annonce->getImgPath2();
        if($imgPath2 !== null && $imgPath2 !== '') {
            $imgPath2 = str_replace('/','\\', $imgPath2);//normalizing forward slashes to backslashes
            $projectDir = $this->getParameter('kernel.project_dir');

            $filesystem->remove($projectDir . '\public_html' . $imgPath2);//removing file at directory
        }

         //remove the image3 if directory exists
         $imgPath3 = $annonce->getImgPath3();
         if($imgPath3 !== null && $imgPath3 !== '') {
             $imgPath3 = str_replace('/','\\', $imgPath3);//normalizing forward slashes to backslashes
             $projectDir = $this->getParameter('kernel.project_dir');
             
             $filesystem->remove($projectDir . '\public_html' . $imgPath3);//removing file at directory
         }

          //remove the image4 if directory exists
          $imgPath4 = $annonce->getImgPath4();
          if($imgPath4 !== null && $imgPath4 !== '') {
              $imgPath4 = str_replace('/','\\', $imgPath4);//normalizing forward slashes to backslashes
              $projectDir = $this->getParameter('kernel.project_dir');
  
              $filesystem->remove($projectDir . '\public_html' . $imgPath4);//removing file at directory
          }

           //remove the image5 if directory exists
         $imgPath5 = $annonce->getImgPath5();
         if($imgPath5 !== null && $imgPath5 !== '') {
             $imgPath5 = str_replace('/','\\', $imgPath5);//normalizing forward slashes to backslashes
             $projectDir = $this->getParameter('kernel.project_dir');
        
             $filesystem->remove($projectDir . '\public_html' . $imgPath5);//removing file at directory
         }

        $entityManager->remove($annonce);
        $entityManager->flush();
        
        return $this->redirectToRoute('app_announcements');
    }
}