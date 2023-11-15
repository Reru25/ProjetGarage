<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\DataFixtures\UserFixtures;
use App\Entity\Reviews;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class zReviewsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $users = $manager->getRepository(User::class)->findAll();

        foreach ($users as $user) {

            $review = new Reviews();
            $review->setGrade(mt_rand(0, 5)); 
            $review->setWasModerated(true);
            $review->setReview("Exemple de commentaire");
            $review->setUserMail($user);

            $manager->persist($review);
        }

        $manager->flush();
    }
    
    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }

}