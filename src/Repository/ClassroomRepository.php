<?php

namespace App\Repository;

use App\Entity\Classroom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Classroom|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classroom|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classroom[]    findAll()
 * @method Classroom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassroomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classroom::class);
    }

    // /**
    //  * @return Classroom[] Returns an array of Classroom objects
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
    public function findOneBySomeField($value): ?Classroom
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findAllClassroom()
    {
        // $em = $this->getDoctrine()->getEntityManager();
        // $q=$em->createQuery(
        //    'select c from from App\Entity\Classroom'
        // );
        // return $q->
    }
    public function classroomInf1($x)
{
    return $this->createQueryBuilder('classroom')
   
     //->from('ZaysoCoreBundle:Account','account')
       // ->andWhere('classroom.id LIKE :searchTerm
       //     OR cat.iconKey LIKE :searchTerm
       //     OR fc.fortune LIKE :searchTerm')
      ->innerJoin('classroom.students', 'st' )
      ->select('count(st.id)')
      ->andWhere('count st.id < 2')

      //  ->andWhere('COUNT st.id < :x')
      //  ->setParameter('x', '%'.$x.'%')
        ->getQuery()
        ->execute();
}
}
