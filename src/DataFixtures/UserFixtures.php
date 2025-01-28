<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {  // Adjust the number as needed
            $user = new User();
            $email = $faker->email();
            $user->setEmail($email);
            $user->setUsername($email);
            $user->setName($faker->name);
            $user->setSurname($faker->name);
            $user->setPassword($faker->password);  // Ensure to hash the password if needed
            // Set other properties...
            $manager->persist($user);
        }

        $manager->flush();
    }
}
