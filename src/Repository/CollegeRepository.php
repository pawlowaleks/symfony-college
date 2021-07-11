<?php

namespace App\Repository;

use App\Entity\College;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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


    public function findOneByTitle($value): ?College
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.title = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * Сохранить Колледж
     * @param string $title
     * @param string|null $city
     * @param string|null $state
     * @param string|null $image
     * @return bool
     */
    public function saveCollege(string $title, ?string $city, ?string $state, ?string $image = null): bool
    {
        $entityManager = $this->getEntityManager();

        $college = $entityManager->getRepository(College::class)->findOneByTitle($title);
        if (empty($college)) {
            $college = new College();
            $college->setTitle($title);
        }

        $college->setCity($city);
        $college->setState($state);
        $college->setImage($image);
        $college->setUpdatedAt(new \DateTimeImmutable());

        $entityManager->persist($college);
        $entityManager->flush();
        return true;
    }

    /**
     * Сохранить детали Колледжа
     * @param string $title
     * @param string|null $address
     * @param string|null $phone
     * @param string|null $site
     * @return bool
     */
    public function saveCollegeDetails(string $title, ?string $address, ?string $phone, ?string $site): bool
    {
        $entityManager = $this->getEntityManager();

        $college = $entityManager->getRepository(College::class)->findOneByTitle($title);
        if (empty($college)) {
            $college = new College();
            $college->setTitle($title);
        }
        $college->setAddress($address);
        $college->setPhone($phone);
        $college->setSite($site);

        $college->setUpdatedAt(new \DateTimeImmutable());
        $entityManager->persist($college);
        $entityManager->flush();
        return true;
    }

    /**
     * @return bool
     */
    public function deleteOldColleges($toTime): int
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'DELETE FROM `college` WHERE updated_at < :toTime';
        $stmt = $conn->prepare($sql);
        return $stmt->executeStatement(['toTime' => $toTime]);
    }

}
