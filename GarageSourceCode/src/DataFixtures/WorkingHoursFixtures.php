<?php

namespace App\DataFixtures;

use App\Entity\WorkingHours;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WorkingHoursFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $hours = new WorkingHours();
        $hours->setMonday('09:00-12:30 et 13:30-17:30');
        $hours->setTuesday('09:00-12:30 et 13:30-17:30');
        $hours->setWednesday('09:00-12:30 et 13:30-17:00');
        $hours->setThursday('09:00-12:30 et 13:30-17:30');
        $hours->setFriday('09:00-12:30 et 13:30-17:30');
        $hours->setSaturday('09:00-12:30');
        $hours->setSunday('Fermé');
        $manager->persist($hours);


        $manager->flush();
    }
}
