<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Utilisateurs;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $utilisateur = new Utilisateurs();
            $utilisateur->setFirstName($faker->firstName);
            $utilisateur->setLastName($faker->lastName);
            $utilisateur->setMail($faker->email);
            $utilisateur->setPhone($faker->phoneNumber);
            $utilisateur->setGender($faker->randomElement($array = array ('male', 'female')));
            $utilisateur->setCity($faker->city);
            $manager->persist($utilisateur);
        }

        $manager->flush();
    }
}
