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
    $rawSql = "select t.libelle as type, m.libelle as matiere, s.code as salle, concat('GR ', g.code) as groupe, CONCAT(e.nom, ' ' ,e.prenom) as enseignant from cours c join matiere m on (c.id_matiere = m.id) join salle s on (c.id_salle = s.id) join groupe g on (c.id_groupe = g.id) join enseignant e on (c.id_enseignant = e.id) join type t on (c.id_type = t.id) where c.id = :id";

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
