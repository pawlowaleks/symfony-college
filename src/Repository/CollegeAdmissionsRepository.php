<?php

namespace App\Repository;

use App\Engine\Entity\CollegeAdmissionsItem;
use App\Entity\College;
use App\Entity\CollegeAdmissions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollegeAdmissions|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollegeAdmissions|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollegeAdmissions[]    findAll()
 * @method CollegeAdmissions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollegeAdmissionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollegeAdmissions::class);
    }

    // /**
    //  * @return CollegeAdmissions[] Returns an array of CollegeAdmissions objects
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
    public function findOneBySomeField($value): ?CollegeAdmissions
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
     * @param CollegeAdmissionsItem $collegeAdmissionsItem
     * @param College $college
     * @return CollegeAdmissions
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function saveCollegeAdmissionsItem(CollegeAdmissionsItem $collegeAdmissionsItem, College $college): CollegeAdmissions
    {
        $entityManager = $this->getEntityManager();

        $collegeAdmissions = $college->getCollegeAdmissions();
        if (empty($collegeAdmissions)) {
            $collegeAdmissions = new CollegeAdmissions();
            $collegeAdmissions->setCollege($college);
        }
        $collegeAdmissions->setApplicants($collegeAdmissionsItem->getApplicants());
        $collegeAdmissions->setAcceptanceRate($collegeAdmissionsItem->getAcceptanceRate());
        $collegeAdmissions->setAverageHSGPA($collegeAdmissionsItem->getAverageHsgpa());
        $collegeAdmissions->setGpaBreakdown($collegeAdmissionsItem->getGpaBreakdown());
        $collegeAdmissions->setTestScores($collegeAdmissionsItem->getTestScores());
        $collegeAdmissions->setDeadlines($collegeAdmissionsItem->getDeadlines());

        $entityManager->persist($collegeAdmissions);
        $entityManager->flush();
        return $collegeAdmissions;
    }

}
