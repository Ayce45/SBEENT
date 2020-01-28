<?php

namespace App\Repository;

use App\Entity\Cours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cours|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cours|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cours[]    findAll()
 * @method Cours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cours::class);
    }

    public function getInformationsById($id)
{
    $rawSql = "SELECT t.libelle as type, m.libelle as matiere, s.code as salle, CONCAT('Gr ', g.code) as groupe, e.nom as enseignant FROM COURS c JOIN MATIERE m ON (c.id_matiere = m.id) JOIN SALLE s ON (c.id_salle = s.id) JOIN GROUPE g ON (c.id_groupe = g.id) JOIN ENSEIGNANT e ON (c.id_enseignant = e.id) JOIN TYPE t ON (c.id_type = t.id) WHERE c.id = :id";

    $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
    $stmt->execute(['id' => $id]);

    return $stmt->fetchAll();
}

    // /**
    //  * @return Cours[] Returns an array of Cours objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cours
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
