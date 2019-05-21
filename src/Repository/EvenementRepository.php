<?php

namespace App\Repository;

use App\Entity\Evenement;
use App\Entity\EvenementRecherche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Classe permettant de réaliser des requêtes SQL auprès de la base de données, sur la table Evenement
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findAll()
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{

    /**
     * Méthode de construction de l'objet
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

    /**
     * Méthode renvoyant les événements sur la page correspondante et triés chronologiquement de façon décroissante
     * @param EvenementRecherche $recherche Recupère une fourchette de date pour renvoyer une liste d'événements
     * @return Evenement[] Retourne une liste d'objet de type Evénement
     */
    public function eventTous(EvenementRecherche $recherche){

        /*return $this->createQueryBuilder('et')
            ->orderBy('et.dateEvent', 'DESC')
            ->getQuery();*/

            $requete = $this->createQueryBuilder('et')
                ->orderBy('et.dateEvent', 'DESC');
            
                if($recherche->getDateMin()){
                    $requete = $requete->andWhere('et.dateEvent >= :dateMinimum')
                        ->setParameter('dateMinimum', $recherche->getDateMin());
                }

                if($recherche->getDateMax()){
                    $requete = $requete->andWhere('et.dateEvent <= :dateMaximum')
                        ->setParameter('dateMaximum', $recherche->getDateMax());
                }

            return $requete->getQuery();

    }

    /**
     * Méthode renvoyant les actualités sur la page correspondante
     * @return Evenement[] Retourne une liste d'objet de type Evénement
     */
    public function eventActu(){
        
        return $this->createQueryBuilder('e')
            ->andwhere('e.dateEvent >= :dateJour')
            ->setParameter('dateJour', date('Y-m-d'))
            ->orderBy('e.dateEvent', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Evenement[] Returns an array of Evenement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Evenement
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
