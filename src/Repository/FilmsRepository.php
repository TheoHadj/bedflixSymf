<?php

namespace App\Repository;

use App\Entity\Categorie;
use App\Entity\Films;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Component\BrowserKit\Response;

/**
 * @extends ServiceEntityRepository<Films>
 */
class FilmsRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Films::class);
    }

    // public function saveFilm(Films $film): array
    //     {
    //         $entityManager = $this->getEntityManager();
        
    //         $query = $entityManager->createQuery(
    //             'SELECT u
    //              FROM App\Entity\User u
    //              -- WHERE u.email=:email
    //              ORDER BY u.email ASC'
    //         );
        
    //         return $query->getResult();
    //     }
        
    public function saveFilm(Films $film): Response {
        $entityManager = $this->getEntityManager();

        try{
            $entityManager->persist($film);
            $entityManager->flush();
            return new Response('bien enregistré');
        }
        catch(Exception $e){
            return new Response("erreur : "+  $e);
            
        }
    }

    // public function getFilmByCategorie(Categorie $categorie): Response {
    //     $entityManager = $this->getEntityManager();

    //     try{

    //         return new Response();
    //     }
    //     catch(Exception $e){
    //         return new Response("erreur : "+  $e);
            
    //     }
    // }
    

    //    /**
    //     * @return Films[] Returns an array of Films objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Films
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
