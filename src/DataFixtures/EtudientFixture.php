<?php

namespace App\DataFixtures;

use App\Entity\Etudient;
use App\Repository\EtudientRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EtudientFixture extends Fixture
{


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr');

        for($i=1; $i<11; $i++){
            $var = new Etudient();
            $var->setNom($faker->firstName );
            $var->setPernom( $faker->lastName);



            $manager->persist($var);
        }

        $manager->flush();
    }
}