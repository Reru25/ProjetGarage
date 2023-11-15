<?php

namespace App\DataFixtures;

use App\Entity\ContactInfo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactInfoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $info = new ContactInfo();
        $info->setEMail("garageExemple@gmail.com");
        $info->setPhoneNumber("+33 0 00 00 00 00");
        $manager->persist($info);


        $manager->flush();
    }
}
