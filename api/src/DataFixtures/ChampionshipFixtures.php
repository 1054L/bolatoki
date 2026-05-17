<?php

namespace App\DataFixtures;

use App\Entity\Championship;
use App\Entity\Mode;
use App\Entity\Pointformat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ChampionshipFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Create some Modes
        $modes = [];
        foreach (['Individual', 'Parejas', 'Equipos'] as $modeName) {
            $mode = new Mode();
            $mode->setName($modeName);
            $manager->persist($mode);
            $modes[] = $mode;
        }

        // Create some PointFormats
        $formats = [];
        foreach (['Estándar', 'Tradicional', 'Puntos Dobles'] as $formatName) {
            $format = new Pointformat();
            $format->setName($formatName);
            $manager->persist($format);
            $formats[] = $format;
        }

        // Create Championships
        for ($i = 0; $i < 10; $i++) {
            $championship = new Championship();
            $championship->setName('Torneo ' . $faker->city . ' ' . $faker->year);
            $championship->setMode($faker->randomElement($modes));
            $championship->setPointformat($faker->randomElement($formats));
            $manager->persist($championship);
        }

        $manager->flush();
    }
}
