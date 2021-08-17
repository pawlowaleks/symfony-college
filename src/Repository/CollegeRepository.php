<?php

namespace App\Repository;

use App\Engine\Entity\CollegeDetailsItem;
use App\Engine\Entity\CollegeListItem;
use App\Entity\College;
use App\Entity\CollegeAdmissions;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method College|null find($id, $lockMode = null, $lockVersion = null)
 * @method College|null findOneBy(array $criteria, array $orderBy = null)
 * @method College[]    findAll()
 * @method College[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollegeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, College::class);
    }

    // /**
    //  * @return College[] Returns an array of College objects
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

    /**
     * @param $value
     * @return College|null
     * @throws NonUniqueResultException
     */
    public function findOneByTitle($value): ?College
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.title = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Сохранить Колледж
     * @param CollegeListItem $item
     * @return bool
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function saveCollege(CollegeListItem $item): bool
    {
        $entityManager = $this->getEntityManager();

        $college = $entityManager->getRepository(College::class)->findOneByTitle($item->getTitle());
        if (empty($college)) {
            $college = new College();
            $college->setTitle($item->getTitle());
        }

        $college->setCity($item->getCity());
        $college->setState($item->getState());
        $college->setImage($item->getImage());
        $college->setUpdatedAt(new DateTimeImmutable());

        if ($item->getMajor()) {
            $college->addMajor($item->getMajor());
        }

        $entityManager->persist($college);
        $entityManager->flush();
        return true;
    }

    /**
     * Сохранить детали Колледжа
     * @param CollegeDetailsItem $item
     * @return bool
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function saveCollegeDetails(CollegeDetailsItem $item): bool
    {
        $entityManager = $this->getEntityManager();

        $college = $entityManager->getRepository(College::class)->findOneByTitle($item->getTitle());
        if (empty($college)) {
            $college = new College();
            $college->setTitle($item->getTitle());
        }
        $college->setAddress($item->getAddress());
        $college->setPhone($item->getPhone());
        $college->setSite($item->getSite());
        $college->setEmail($item->getEmail());

        $college->setUpdatedAt(new DateTimeImmutable());

        $college->setCampusVisitingCenter($item->getCampusVisitingCenter());
        $college->setCampusTours($item->getCampusTours());
        $college->setOnCampusInterview($item->getOnCampusInterview());

        $entityManager->persist($college);
        $entityManager->flush();

        $collegeAdmissionsItem = $item->getCollegeAdmissionsItem();
        if (isset($collegeAdmissionsItem)) {
            $collegeAdmissions = $entityManager->getRepository(CollegeAdmissions::class)
                ->saveCollegeAdmissionsItem($collegeAdmissionsItem, $college);
        }

        return true;
    }

    /**
     * Удалить устаревшие колледжи
     * @return int Количество удаленных колледжей
     */
    public function deleteOldColleges($toTime): int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'DELETE FROM `college` WHERE updated_at < :toTime';
        $stmt = $conn->prepare($sql);
        return $stmt->executeStatement(['toTime' => $toTime]);
    }

}
