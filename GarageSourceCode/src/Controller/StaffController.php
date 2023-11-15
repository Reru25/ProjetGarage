<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ContactInfoRepository;
use App\Repository\WorkingHoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StaffController extends AbstractController
{
    #[Route('/ajouter-emploie', name: 'app_add_staff')]
    public function add(
        EntityManagerInterface $entityManager,
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository
    ): Response
    {
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setIsVerified(true);
            $user->setRoles(array('ROLE_STAFF'));
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_private_space');
        }

        return $this->render('add_staff.html.twig', [
            'controller_name' => 'AddStaffController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/list-emploie', name: 'app_staff')]
    public function show(
        UserRepository $userRepository,
        ContactInfoRepository $contactInfoRepository,
        WorkingHoursRepository $workingHoursRepository
    ): Response
    {
        $staff = $userRepository->createQueryBuilder('u')
        ->where('u.roles LIKE :role')
        ->setParameter('role', '%"ROLE_STAFF"%')
        ->getQuery()
        ->getResult();
        $users = $userRepository->createQueryBuilder('u')
        ->where('u.roles LIKE :role')
        ->setParameter('role', '%"ROLE_USER"%')
        ->getQuery()
        ->getResult();
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();


        return $this->render('staff.html.twig', [
            'controller_name' => 'AddStaffController',
            'shedule' => $schedule[0],
            'contact' => $contact[0],
            'staffList' => $staff,
            'usersList' => $users,
        ]);
    }

    #[Route('/supprimer-staff{id}', name: 'app_delete_staff')]
    public function delete(
        $id,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
    ): Response
    {

        $staff = $userRepository->find($id);

        if (!$staff) {
            throw new NotFoundHttpException('Annonce not found'); 
        }

        $entityManager->remove($staff);
        $entityManager->flush();
        
        return $this->redirectToRoute('app_staff');

    }
}
