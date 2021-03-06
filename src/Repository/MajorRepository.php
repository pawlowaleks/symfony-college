<?php

namespace App\Repository;

use App\Engine\Entity\MajorCategoryListItem;
use App\Entity\Major;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Major|null find($id, $lockMode = null, $lockVersion = null)
 * @method Major|null findOneBy(array $criteria, array $orderBy = null)
 * @method Major[]    findAll()
 * @method Major[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MajorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Major::class);
    }

    // /**
    //  * @return Major[] Returns an array of Major objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findOneByTitle($value): ?Major
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.title = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param MajorCategoryListItem $item
     * @return Major|null
     */
    public function saveMajorDetails(MajorCategoryListItem $item): ?Major
    {
        $parentMajor = null;
        if (!empty($item->getParentMajor())) {
            $parentMajor = $this->saveMajorItem($item->getParentMajor());
        }

        return $this->saveMajorItem($item, $parentMajor);

    }

    /**
     * @param MajorCategoryListItem $item
     * @param Major|null $parentMajor
     * @return Major|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    private function saveMajorItem(MajorCategoryListItem $item, Major $parentMajor = null): ?Major
    {
        $entityManager = $this->getEntityManager();

        $major = $this->getEntityManager()->getRepository(Major::class)->findOneByTitle($item->getTitle());
        if (empty($major)) {
            $major = new Major();
            $major->setTitle($item->getTitle());
        }

        $major->setParentMajor($parentMajor);

        $entityManager->persist($major);
        $entityManager->flush();

        return $major;
    }

}
