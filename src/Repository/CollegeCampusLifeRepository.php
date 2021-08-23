<?php

namespace App\Repository;

use App\Engine\Entity\CollegeCampusLifeItem;
use App\Entity\College;
use App\Entity\CollegeCampusLife;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollegeCampusLife|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollegeCampusLife|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollegeCampusLife[]    findAll()
 * @method CollegeCampusLife[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollegeCampusLifeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollegeCampusLife::class);
    }

    // /**
    //  * @return CollegeCampusLife[] Returns an array of CollegeCampusLife objects
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
    public function findOneBySomeField($value): ?CollegeCampusLife
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
     * @param CollegeCampusLifeItem $item
     * @param College $college
     * @return CollegeCampusLife|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function saveCollegeCampusLifeItem(CollegeCampusLifeItem $item, College $college): ?CollegeCampusLife
    {
        $entityManager = $this->getEntityManager();

        $collegeCampusLife = $college->getCollegeCampusLife();
        if (empty($collegeCampusLife)) {
            $collegeCampusLife = new CollegeCampusLife();
            $collegeCampusLife->setCollege($college);
        }

        $collegeCampusLife->setOverview($item->getOverview());
        $collegeCampusLife->setUndergradsLivingOnCampus($item->getUndergradsLivingOnCampus());
        $collegeCampusLife->setHelpFindingOffCampusHousing($item->getHelpFindingOffCampusHousing());
        $collegeCampusLife->setQualityOfLifeRating($item->getQualityOfLifeRating());
        $collegeCampusLife->setFirstYearStudentsLivingOnCampus($item->getFirstYearStudentsLivingOnCampus());
        $collegeCampusLife->setCampusEnvironment($item->getCampusEnvironment());
        $collegeCampusLife->setFireSafetyRating($item->getFireSafetyRating());

        $collegeCampusLife->setHousingOptions($item->getHousingOptions());

        $collegeCampusLife->setCollegeEntranceTestsRequired($item->getCollegeEntranceTestsRequired());
        $collegeCampusLife->setInterviewRequired($item->getInterviewRequired());

        $collegeCampusLife->setSpecialNeedServicesOffered($item->getSpecialNeedServicesOffered());

        $collegeCampusLife->setRegisteredStudentOrganizations($item->getRegisteredStudentOrganizations());
        $collegeCampusLife->setNumberOfHonorSocieties($item->getNumberOfHonorSocieties());
        $collegeCampusLife->setNumberOfSocialSororities($item->getNumberOfSocialSororities());
        $collegeCampusLife->setNumberOfReligiousOrganizations($item->getNumberOfReligiousOrganizations());

        $collegeCampusLife->setAthleticDivision($item->getAthleticDivision());
        $collegeCampusLife->setMenSports($item->getMenSports());
        $collegeCampusLife->setWomenSports($item->getWomenSports());

        $collegeCampusLife->setStudentServices($item->getStudentServices());

        $collegeCampusLife->setSustainability($item->getSustainability());
        $collegeCampusLife->setGreenRating($item->getGreenRating());

        $collegeCampusLife->setCampusSecurityReport($item->getCampusSecurityReport());

        $collegeCampusLife->setCampusWideInternetNetwork($item->getCampusWideInternetNetwork());
        $collegeCampusLife->setPercentOfClassroomsWithWirelessInternet($item->getPercentOfClassroomsWithWirelessInternet());
        $collegeCampusLife->setFeeForNetworkUse($item->getFeeForNetworkUse());
        $collegeCampusLife->setPartnershipsWithTechnologyCompanies($item->getPartnershipsWithTechnologyCompanies());
        $collegeCampusLife->setPersonalComputerIncludedInTuitionForEachStudent($item->getPersonalComputerIncludedInTuitionForEachStudent());
        $collegeCampusLife->setDiscountsAvailableWithHardwareVendors($item->getDiscountsAvailableWithHardwareVendors());
        $collegeCampusLife->setHardwareVendorsDescription($item->getHardwareVendorsDescription());


        $entityManager->persist($collegeCampusLife);
        $entityManager->flush();
        return $collegeCampusLife;
    }


}
