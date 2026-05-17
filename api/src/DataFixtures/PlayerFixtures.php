<?php

namespace App\DataFixtures;

use App\Entity\Club;
use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PlayerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('es_ES');

        // Create some Clubs first
        $clubs = [];
        foreach (['Club Hernani', 'Ategorrieta Taldea', 'Euskal Bola', 'Donosti Bolatoki'] as $clubName) {
            $club = new Club();
            $club->setName($clubName);
            $manager->persist($club);
            $clubs[] = $club;
        }

        // Create Players
        for ($i = 0; $i < 20; $i++) {
            $player = new Player();
            $player->setName($faker->firstName);
            $player->setSurname($faker->lastName . ' ' . $faker->lastName);
            $player->setGender($faker->randomElement([1, 2]));
            $player->setProvince($faker->city);
            $player->setFederated($faker->boolean(80));
            $player->setClub($faker->randomElement($clubs));
            $manager->persist($player);
        }

        $manager->flush();
    }
}
