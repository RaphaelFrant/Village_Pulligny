<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Evenement;
use Faker\Factory;

/**
 * Classe permettant de générer des objets Evenement de façon aléatoire
 */
class AppFixtures extends Fixture
{
    /**
     * Méthode de création d'objet Evénement dans la base de données
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        

        $faker = Factory::create('fr_FR');
        for($i = 0; $i < 10; $i++){
            $event = new Evenement();
            $event -> setTitre($faker->word)
                ->setType($faker->word)
                ->setDescription($faker->sentence)
                ->setDateEvent(new \DateTime($faker->date))
                ->setInscription($faker->boolean);
            $manager->persist($event);
        }

        $manager->flush();
    }
}
