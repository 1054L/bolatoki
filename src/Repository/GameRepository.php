<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    // public function findFromToday(): array
    // {
    //     return $this->createQueryBuilder('g')
    //         ->where('g.date >= :today')
    //         ->setParameter('today', new \DateTime('today'))
    //         ->orderBy('g.date', 'ASC')
    //         ->orderBy('g.id', 'ASC')
    //         ->getQuery()
    //         ->getResult();
    // }

    public function findGroupedByDate(): array
    {
        $today = new \DateTimeImmutable('today');
        $tomorrow = $today->modify('+1 day');

        // Query builder para todos los juegos
        $qb = $this->createQueryBuilder('g')
            ->orderBy('g.date', 'ASC')
            ->addOrderBy('g.id', 'ASC');

        $allGames = $qb->getQuery()->getResult();

        $result = [
            'past' => [],
            'today' => [],
            'future' => []
        ];

        foreach ($allGames as $game) {
            if ($game->getDate() < $today) {
                $result['past'][] = $game;
            } elseif ($game->getDate() >= $today && $game->getDate() < $tomorrow) {
                $result['today'][] = $game;
            } else {
                $result['future'][] = $game;
            }
        }
        // $result['past'] = array_slice($result['past'], -1);

        return $result;
    }


    //    /**
    //     * @return Game[] Returns an array of Game objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Game
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
