<?php

namespace App\Controller;

use App\Entity\Services;
use App\Form\ServiceType;
use App\Repository\ServicesRepository;
use App\Repository\ContactInfoRepository;
use App\Repository\WorkingHoursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ServicesController extends AbstractController
{
    #[Route('/services', name: 'app_services')]
    public function show(
        ServicesRepository $servicesRepository,
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository
    ): Response
    {
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();
        $services = $servicesRepository->findAll();

        return $this->render('services.html.twig', [
            'controller_name' => 'ServicesController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'services' => $services,
        ]);
    }

    #[Route('/ajouter-service', name: 'app_add_services')]
    public function add(
        Request $request,
        EntityManagerInterface $entityManager,
        ServicesRepository $servicesRepository,
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository
    ): Response
    {
        $service = new Services();
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();
        $services = $servicesRepository->findAll();
        
        $serviceForm = $this->createForm(ServiceType::class, $service);
        $serviceForm->handleRequest($request);
        if ($serviceForm->isSubmitted() && $serviceForm->isValid()) {

            $newService = $serviceForm->getData();

            $imagePath = $serviceForm->get('imgPath')->getData();
            if($imagePath){
                $newFileName = uniqid() . '.'. $imagePath->guessExtension();

                $imagePath->move(
                    $this->getParameter('kernel.project_dir') . '/public_html/sources/services',
                    $newFileName
                );

                $newService->setImgPath('sources/services/'. $newFileName);
            }

            $entityManager->persist($newService);
            $entityManager->flush();
            return $this->redirectToRoute('app_private_space');
        };

        return $this->render('add_service.html.twig', [
            'controller_name' => 'ServicesController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'services' => $services,
            'form' => $serviceForm -> createView(),
        ]);
    }

    #[Route('/supprimer-service{id}', name: 'app_delete_services')]
    public function delete(
        $id,
        Filesystem $filesystem,
        Request $request,
        EntityManagerInterface $entityManager,
        ServicesRepository $servicesRepository,
    ): Response
    {
        //looking for serivce with specified id
        $service = $servicesRepository->find($id);

        //check if still exists
        if (!$service) {
            throw new NotFoundHttpException('Annonce not found'); 
        }

        //remove the image if exists
        $imgPath = $service->getImgPath();
        if($imgPath !== null && $imgPath !== '') {
            $imgPath = str_replace('/','\\', $imgPath);//normalizing forward slashes to backslashes
            $projectDir = $this->getParameter('kernel.project_dir');
            $filesystem->remove($projectDir . '\public_html\\' . $imgPath);
        }

        //remove the service
        $entityManager->remove($service);
        $entityManager->flush();

        return $this->redirectToRoute('app_services');
    }
}
