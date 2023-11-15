<?php

namespace App\DataFixtures;

use App\Entity\Services;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServicesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $service1 = new Services();
        $service1->setTitle('Vidange');
        $service1->setDescription('Vidange complète à prix fixe !');
        $service1->setPrice('25,99');
        $service1->setImgPath('sources/services/vidange.jpg');
        $manager->persist($service1);

        $service2 = new Services();
        $service2->setTitle('Changement pneu');
        $service2->setDescription("Profitez de notre offre du moment ! Seulement 10€ par pneu !");
        $service2->setPrice('10');
        $service2->setImgPath('sources/services/pneu.jpg');
        $manager->persist($service2);

        $service3 = new Services();
        $service3->setTitle('Diagnostic suspension');
        $service3->setDescription("Diagnostic complet des systèmes de suspension. Obtenez un devis personnalisé !");
        $service3->setPrice(null);
        $service3->setImgPath('sources/services/suspension.jpg');
        $manager->persist($service3);

        $service5 = new Services();
        $service5->setTitle('Remplissage AC');
        $service5->setDescription("Soyez prêt pour l'été, remplissage de l'AC à prix fixe !");
        $service5->setPrice('60');
        $service5->setImgPath('sources/services/ac.jpg');
        $manager->persist($service5);

        $service6 = new Services();
        $service6->setTitle('Révision des freins');
        $service6->setDescription("Révision complète des systèmes de freinage.");
        $service6->setPrice('253');
        $service6->setImgPath('sources/services/brakes.jpg');
        $manager->persist($service6);

        $service7 = new Services();
        $service7->setTitle('Changement accumulateur');
        $service7->setDescription("Seulement 20€ pour l'installation de la batterie achetée dans notre garage !");
        $service7->setPrice('20');
        $service7->setImgPath('sources/services/batterie.jpg');
        $manager->persist($service7);

        $manager->flush();
    }
}
