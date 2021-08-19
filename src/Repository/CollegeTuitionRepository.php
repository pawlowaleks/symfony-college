<?php

namespace App\Repository;

use App\Engine\Entity\CollegeTuitionItem;
use App\Entity\College;
use App\Entity\CollegeTuition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollegeTuition|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollegeTuition|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollegeTuition[]    findAll()
 * @method CollegeTuition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollegeTuitionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollegeTuition::class);
    }

    // /**
    //  * @return CollegeTuition[] Returns an array of CollegeTuition objects
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
    public function findOneBySomeField($value): ?CollegeTuition
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
     * @param CollegeTuitionItem $item
     * @param College $college
     * @return CollegeTuition|null
     */
    public function saveCollegeTuitionItem(CollegeTuitionItem $item, College $college): ?CollegeTuition
    {
        $entityManager = $this->getEntityManager();

        $collegeTuition = $college->getCollegeTuition();
        if (empty($collegeTuition)) {
            $collegeTuition = new CollegeTuition();
            $collegeTuition->setCollege($college);
        }

        // Dates
        $collegeTuition->setApplicationDeadlines($item->getApplicationDeadlines());
        $collegeTuition->setNotificationDate($item->getNotificationDate());

        // Required Forms
        $collegeTuition->setRequiredForms($item->getRequiredForms());

        // Financial Aid Statistics
        $collegeTuition->setAverageFreshmanTotalNeedBasedGiftAid($item->getAverageFreshmanTotalNeedBasedGiftAid());
        $collegeTuition->setAverageUndergraduateTotalNeedBasedGiftAid($item->getAverageUndergraduateTotalNeedBasedGiftAid());
        $collegeTuition->setAverageNeedBasedLoan($item->getAverageNeedBasedLoan());
        $collegeTuition->setUndergraduatesWhoHaveBorrowedThroughAnyLoanProgram($item->getUndergraduatesWhoHaveBorrowedThroughAnyLoanProgram());
        $collegeTuition->setAverageAmountOfLoanDebtPerGraduate($item->getAverageAmountOfLoanDebtPerGraduate());
        $collegeTuition->setAverageAmountOfEachFreshmanScholarshipGrantPackage($item->getAverageAmountOfEachFreshmanScholarshipGrantPackage());
        $collegeTuition->setFinancialAidProvidedToInternationalStudents($item->getFinancialAidProvidedToInternationalStudents());

        // Expenses per Academic Year
        $collegeTuition->setTuitionInState($item->getTuitionInState());
        $collegeTuition->setTuitionOutOfState($item->getTuitionOutOfState());
        $collegeTuition->setRequiredFees($item->getRequiredFees());
        $collegeTuition->setAverageCostForBooksAndSupplies($item->getAverageCostForBooksAndSupplies());
        $collegeTuition->setTuitionFeesVaryByYearOfStudy($item->getTuitionFeesVaryByYearOfStudy());
        $collegeTuition->setBoardForCommuters($item->getBoardForCommuters());
        $collegeTuition->setTransportationForCommuters($item->getTransportationForCommuters());
        $collegeTuition->setOnCampusRoomAndBoard($item->getOnCampusRoomAndBoard());

        // Available Aid
        $collegeTuition->setFinancialAidMethodology($item->getFinancialAidMethodology());
        $collegeTuition->setScholarshipsAndGrantsNeedBased($item->getScholarshipsAndGrantsNeedBased());
        $collegeTuition->setScholarshipsAndGrantsNonNeedBased($item->getScholarshipsAndGrantsNonNeedBased());
        $collegeTuition->setFederalDirectStudentLoanPrograms($item->getFederalDirectStudentLoanPrograms());
        $collegeTuition->setFederalFamilyEducationLoanPrograms($item->getFederalFamilyEducationLoanPrograms());
        $collegeTuition->setIsInstitutionalEmploymentAvailable($item->getIsInstitutionalEmploymentAvailable());
        $collegeTuition->setDirectLender($item->getDirectLender());


        $entityManager->persist($collegeTuition);
        $entityManager->flush();
        return $collegeTuition;
    }

}
