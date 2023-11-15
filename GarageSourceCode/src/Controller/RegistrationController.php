<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\ContactInfoRepository;
use App\Repository\WorkingHoursRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;
    private ?User $user = null;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request,
    UserPasswordHasherInterface $userPasswordHasher, 
    ContactInfoRepository $contactInfoRepository,
    WorkingHoursRepository $workingHoursRepository,
    SessionInterface $session
    ): Response
    {
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();

        $this->user = new User();
        $form = $this->createForm(RegistrationFormType::class, $this->user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->user->setRoles(["ROLE_USER"]);
            // encode the plain password
            $this->user->setPassword(
                $userPasswordHasher->hashPassword(
                    $this->user,
                    $form->get('plainPassword')->getData()
                )
            );

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $this->user,
                (new TemplatedEmail())
                    ->from(new Address('test@gmail.com', 'Mail bot'))
                    ->to($this->user->getEmail())
                    ->subject('Confirmation de votre E-mail')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            // Save user in session
            $session->set('user_to_verify', $this->user);
            
            //redirect to message of mail has been sent
            return $this->redirectToRoute('app_email_sent');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'shedule' => $schedule[0],
            'contact' => $contact[0],
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, EntityManagerInterface $entityManager, SessionInterface $session): Response
    {
        // Retrieve user from session
        $this->user = $session->get('user_to_verify');

        //check if exists in session
        if (!$this->user instanceof User) {
            throw $this->createNotFoundException('User not found in session.');//error if not
        } else {
            //persist new user in data base
            $this->user->setIsVerified(true);
            $entityManager->persist($this->user);
            $entityManager->flush();

            //redirect to index page
            return $this->redirectToRoute('app_email_confirmed');
        }

    }

    #[Route('/email-message', name: 'app_email_sent')]
    public function showMessage1(Request $request,
    UserPasswordHasherInterface $userPasswordHasher, 
    ContactInfoRepository $contactInfoRepository,
    WorkingHoursRepository $workingHoursRepository,
    SessionInterface $session
    ): Response
    {
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();


        return $this->render('message_email_sent.html.twig', [
            'shedule' => $schedule[0],
            'contact' => $contact[0],
        ]);
    }

    #[Route('/email-confirmation', name: 'app_email_confirmed')]
    public function showMessage2(Request $request,
    UserPasswordHasherInterface $userPasswordHasher, 
    ContactInfoRepository $contactInfoRepository,
    WorkingHoursRepository $workingHoursRepository,
    SessionInterface $session
    ): Response
    {
        $schedule = $workingHoursRepository->findAll();
        $contact = $contactInfoRepository->findAll();


        return $this->render('message_email_confirmed.html.twig', [
            'shedule' => $schedule[0],
            'contact' => $contact[0],
        ]);
    }
}
