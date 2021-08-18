<?php

namespace App\Repository;

use App\Engine\Entity\CollegeCareersItem;
use App\Entity\College;
use App\Entity\CollegeCareers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollegeCareers|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollegeCareers|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollegeCareers[]    findAll()
 * @method CollegeCareers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollegeCareersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollegeCareers::class);
    }

    // /**
    //  * @return CollegeCareers[] Returns an array of CollegeCareers objects
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
    public function findOneBySomeField($value): ?CollegeCareers
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
     * @param CollegeCareersItem $item
     * @param College $college
     * @return CollegeCareers|null
     */
    public function saveCollegeCareersItem(CollegeCareersItem $item, College $college): ?CollegeCareers
    {
        $entityManager = $this->getEntityManager();

        $collegeCareers = $college->getCollegeCareers();
        if (empty($collegeCareers)) {
            $collegeCareers = new CollegeCareers();
            $collegeCareers->setCollege($college);
        }

        $collegeCareers->setGraduateIn4Years($item->getGraduateIn4Years());
        $collegeCareers->setGraduateIn5Years($item->getGraduateIn5Years());
        $collegeCareers->setGraduateIn6Years($item->getGraduateIn6Years());

        $collegeCareers->setOnCampusJobInterviewsAvailable($item->getOnCampusJobInterviewsAvailable());
        $collegeCareers->setCareerServices($item->getCareerServices());

        $collegeCareers->setStartingMedianSalaryUpToBachelorsDegreeCompletedOnly($item->getStartingMedianSalaryUpToBachelorsDegreeCompletedOnly());
        $collegeCareers->setMidCareerMedianSalaryUptoBachelorsDegreeCompletedOnly($item->getMidCareerMedianSalaryUptoBachelorsDegreeCompletedOnly());
        $collegeCareers->setStartingMedianSalaryAtLeastBachelorsDegree($item->getStartingMedianSalaryAtLeastBachelorsDegree());
        $collegeCareers->setMidCareerMedianSalaryAtLeastBachelorsDegree($item->getMidCareerMedianSalaryAtLeastBachelorsDegree());

        $collegeCareers->setPercentHighJobMeaning($item->getPercentHighJobMeaning());
        $collegeCareers->setPercentSTEM($item->getPercentSTEM());

        $collegeCareers->setRoiRating($item->getRoiRating());

        $entityManager->persist($collegeCareers);
        $entityManager->flush();
        return $collegeCareers;
    }

}
