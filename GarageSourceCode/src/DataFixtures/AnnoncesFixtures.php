<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnnoncesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $description = "
        Lorem ipsum dolor sit amet, 
        
        consectetur adipiscing elit. Phasellus ut blandit enim. 
        Donec sagittis porttitor malesuada. Proin posuere ultrices mauris, 
        a feugiat nisl vehicula sit amet. Suspendisse quis imperdiet diam.
        
        nibh - auctor nibh
        nibh - auctor nibh
        nibh - auctor nibh
        nibh - auctor nibh

        -Praesent
        -Praesent
        -Praesent
        -Praesent
        -Praesent
        -Praesent
        
        eget auctor nibh. Praesent sed nunc et nibh consectetur mattis. Etiam eu congue lectus, in lobortis ex. Cras maximus magna nec tempor hendrerit. Proin id accumsan justo, ut hendrerit massa. Sed eu sem turpis.
        Aliquam sagittis, mauris at tristique placerat, libero est molestie nunc, sit amet rhoncus ligula urna vitae lectus. Duis vel ipsum pharetra, sodales justo sed, tincidunt leo. Fusce gravida porta sem, quis pulvinar odio ultrices id. 
        ";

        $annonce = new Annonce();
        $annonce->setBrand("Renault");
        $annonce->setModel("Clio");
        $annonce->setDescription($description);
        $annonce->setYear(2017);
        $annonce->setMileage(25765);
        $annonce->setFuelType("Diesel");
        $annonce->setTransmission("Manuel");
        $annonce->setPrice(7500);
        $annonce->setImgPath1("sources/annonces/renault1.jpg");
        $annonce->setImgPath2("sources/annonces/renault2.jpg");
        $annonce->setImgPath3("sources/annonces/renault3.jpg");
        $annonce->setImgPath4("");
        $annonce->setImgPath5("");
        $manager->persist($annonce);

        $annonce2 = new Annonce();
        $annonce2->setBrand("Ferrari");
        $annonce2->setModel("California");
        $annonce2->setDescription($description);
        $annonce2->setYear(2010);
        $annonce2->setMileage(64350);
        $annonce2->setFuelType("Essence");
        $annonce2->setTransmission("Automatique");
        $annonce2->setPrice(143000);
        $annonce2->setImgPath1("sources/annonces/Ferrari1.jpg");
        $annonce2->setImgPath2("sources/annonces/Ferrari2.jpg");
        $annonce2->setImgPath3("sources/annonces/Ferrari3.jpg");
        $annonce2->setImgPath4("sources/annonces/Ferrari4.jpg");
        $annonce2->setImgPath5("sources/annonces/Ferrari5.jpg");
        $manager->persist($annonce2);

        $annonce3 = new Annonce();
        $annonce3->setBrand("Peugeot");
        $annonce3->setModel("3008");
        $annonce3->setDescription($description);
        $annonce3->setYear(2018);
        $annonce3->setMileage(125330);
        $annonce3->setFuelType("Essence");
        $annonce3->setTransmission("Automatique");
        $annonce3->setPrice(19500);
        $annonce3->setImgPath1("sources/annonces/peugeot1.jpg");
        $annonce3->setImgPath2("sources/annonces/peugeot2.jpg");
        $annonce3->setImgPath3("sources/annonces/peugeot3.jpg");
        $annonce3->setImgPath4("");
        $annonce3->setImgPath5("");
        $manager->persist($annonce3);

        $annonce4 = new Annonce();
        $annonce4->setBrand("Renault");
        $annonce4->setModel("Twingo");
        $annonce4->setDescription($description);
        $annonce4->setYear(1999);
        $annonce4->setMileage(103000);
        $annonce4->setFuelType("Diesel");
        $annonce4->setTransmission("Manuelle");
        $annonce4->setPrice(1900);
        $annonce4->setImgPath1("sources/annonces/twingo1.jpg");
        $annonce4->setImgPath2("sources/annonces/twingo2.jpg");
        $annonce4->setImgPath3("sources/annonces/twingo3.jpg");
        $annonce4->setImgPath4("");
        $annonce4->setImgPath5("");
        $manager->persist($annonce4);

        $manager->flush();
    }
}
