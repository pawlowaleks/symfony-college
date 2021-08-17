<?php

namespace App\Repository;

use App\Engine\Entity\CollegeAcademicsItem;
use App\Entity\College;
use App\Entity\CollegeAcademics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollegeAcademics|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollegeAcademics|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollegeAcademics[]    findAll()
 * @method CollegeAcademics[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollegeAcademicsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollegeAcademics::class);
    }

    // /**
    //  * @return CollegeAcademics[] Returns an array of CollegeAcademics objects
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
    public function findOneBySomeField($value): ?CollegeAcademics
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @param CollegeAcademicsItem $item
     * @param College $college
     * @return CollegeAcademics
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function saveCollegeAcademicsItem(CollegeAcademicsItem $item, College $college): CollegeAcademics
    {
        $entityManager = $this->getEntityManager();

        $collegeAcademics = $college->getCollegeAcademics();
        if (empty($collegeAcademics)) {
            $collegeAcademics = new CollegeAcademics();
            $collegeAcademics->setCollege($college);
        }

        $collegeAcademics->setMajors($item->getMajors());
        $collegeAcademics->setDegrees($item->getDegrees());
        $collegeAcademics->setProminentAlumni($item->getProminentAlumni());

        $entityManager->persist($collegeAcademics);
        $entityManager->flush();
        return $collegeAcademics;
    }


}
