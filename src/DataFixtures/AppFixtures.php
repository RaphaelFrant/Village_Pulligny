<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Evenement;
use Faker\Factory;

class AppFixtures extends Fixture
{
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
