<?php

namespace App\EventListener;

use App\Entity\Stake;
use App\Entity\TotalPlayerChampionship;
use App\Repository\TotalPlayerChampionshipRepository;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\EntityManagerInterface;

#[AsEntityListener(event: 'postUpdate', entity: Stake::class)]
class StakeUpdateListener
{
    public function __construct(
        private EntityManagerInterface $em,
        private TotalPlayerChampionshipRepository $totalRepo
    ) {}

    public function postUpdate(Stake $stake): void
    {
        $player = $stake->getPlayer();
        $game = $stake->getGame();
        $championships = $game->getChampionships();

        foreach ($championships as $championship) {
            $total = $this->totalRepo->findOneBy([
                'player' => $player,
                'championship' => $championship
            ]);

            if (!$total) {
                $total = new TotalPlayerChampionship();
                $total->setPlayer($player);
                $total->setChampionship($championship);
                $this->em->persist($total);
            }

            $newTotal = $this->totalRepo->calculateTotalForPlayerInChampionship($player, $championship);
            $total->setTotal($newTotal);
        }

        $this->em->flush();  // Guarda los cambios
    }
}