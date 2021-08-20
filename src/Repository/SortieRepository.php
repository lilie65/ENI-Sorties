<?php

namespace App\Repository;

use App\Entity\Campus;
use App\Entity\ListRecherche;
use App\Entity\Participant;
use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use http\Client\Curl\User;
use mysql_xdevapi\Result;

/**
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }

    public function filtreCampus(ListRecherche $listRecherche, Participant $participant)
    {
        $queryBuilder = $this->createQueryBuilder('s');

        if ($listRecherche->getCampus()) {
            $queryBuilder->andWhere('s.campus= :idcampus');
            $queryBuilder->setParameter('idcampus', $listRecherche->getCampus()->getId());
        }

        if ($listRecherche->getDateDebut()) {
            $queryBuilder->andWhere('s.dateHeureDebut >= :dateDebut');
            $queryBuilder->setParameter('dateDebut', $listRecherche->getDateDebut());
        }
        if ($listRecherche->getDateFin()) {
            $queryBuilder->andWhere('s.dateHeureDebut <= :dateFin');
            $queryBuilder->setParameter('dateFin', $listRecherche->getDateFin());
        }
        if ($listRecherche->getSortiePassee()) {
            $queryBuilder->andWhere('s.etat = 3');
        }
        if ($listRecherche->getSortieInscrit() && $participant) {
            $queryBuilder->leftJoin('s.participants', 'p');
            $queryBuilder->andWhere('p = :part');
            $queryBuilder->setParameter('part', $participant);
        }
        if ($listRecherche->getSortieNonInscrit() && $participant) {
            $queryBuilder->leftJoin('s.participants', 'np');
            $queryBuilder->andWhere('np != :part');
            $queryBuilder->setParameter('part', $participant);
        }
        if ($listRecherche->getNom()) {
            $queryBuilder->andWhere('s.nom like :nom');
            $queryBuilder->setParameter('nom', '%' . $listRecherche->getNom() . '%');
        }
        if ($listRecherche->getSortieOrganisateur() && $participant) {
            $queryBuilder->andWhere('s.organisateur = :organisateur');
            $queryBuilder->setParameter('organisateur', $participant);
        }


        $query = $queryBuilder->getQuery();

        return $query->getResult();
    }





    // /**
    //  * @return Sortie[] Returns an array of Sortie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sortie
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
