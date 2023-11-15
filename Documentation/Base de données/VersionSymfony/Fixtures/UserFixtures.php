<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setEmail("user{$i}@exemple.com");
            $user->setRoles(["ROLE_USER"]);
            $user->setIsVerified(true);

            // Хеширование пароля
            $hashedPassword = $this->passwordHasher->hashPassword($user, '!!!MDP!!!');
            $user->setPassword($hashedPassword);

            $manager->persist($user);

        }

        for ($i = 1; $i <= 3; $i++) {
            $user = new User();
            $user->setEmail("staff{$i}@exemple.com");
            $user->setRoles(["ROLE_STAFF"]);
            $user->setIsVerified(true);

            // Хеширование пароля
            $hashedPassword = $this->passwordHasher->hashPassword($user, '!!!MDP!!!');
            $user->setPassword($hashedPassword);

            $manager->persist($user);
        }


        $user1 = new User();
        $user1->setEmail("admin@main.com");
        $user1->setRoles(["ROLE_ADMIN"]);
        $user1->setIsVerified(true);
        $hashedPassword = $this->passwordHasher->hashPassword($user1, '!!!MDP!!!');
        $user1->setPassword($hashedPassword);
        $manager->persist($user1);


        $manager->flush();

    }
}