<?php

namespace App\Repository;

use App\Entity\Championship;
use App\Entity\Player;
use App\Entity\TotalPlayerChampionship;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TotalPlayerChampionship>
 */
class TotalPlayerChampionshipRepository extends ServiceEntityRepository
{
    // @ORM\ManyToOne(targetEntity=Player::class)
    private $player;

    // @ORM\ManyToOne(targetEntity=Championship::class)
    private $championship;
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TotalPlayerChampionship::class);
    }

    public function calculateTotalForPlayerInChampionship(Player $player, Championship $championship): int
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('SUM(s.total)')
            ->from('App\Entity\Stake', 's')
            ->join('s.game', 'g')
            ->join('g.championships', 'c')  // Asegúrate que Game tiene championships
            ->where('s.player = :player')
            ->andWhere('c = :championship')
            ->setParameter('player', $player)
            ->setParameter('championship', $championship);

        return (int) $qb->getQuery()->getSingleScalarResult();
    }

    //    /**
    //     * @return TotalPlayerChampionship[] Returns an array of TotalPlayerChampionship objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?TotalPlayerChampionship
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
