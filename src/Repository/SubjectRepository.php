<?php

namespace App\Repository;

use App\Engine\Entity\SubjectItem;
use App\Entity\Subject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Subject|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subject|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subject[]    findAll()
 * @method Subject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subject::class);
    }

    // /**
    //  * @return Subject[] Returns an array of Subject objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    /**
     * @param $value
     * @return Subject|null
     * @throws NonUniqueResultException
     */
    public function findOneByTitle($value): ?Subject
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.title = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param SubjectItem $item
     * @return Subject|null
     */
    public function saveSubjectItem(SubjectItem $item): ?Subject
    {
        $parentSubject = null;
        if (!empty($item->getParentSubjectItem())) {
            $parentSubject = $this->saveSubject($item->getParentSubjectItem());
        }

        return $this->saveSubject($item, $parentSubject);
    }

    /**
     * @param SubjectItem $subjectItem
     * @param Subject|null $parentSubject
     * @return Subject|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    private function saveSubject(SubjectItem $subjectItem, Subject $parentSubject = null): ?Subject
    {
        $entityManager = $this->getEntityManager();
        $subject = $entityManager->getRepository(Subject::class)->findOneByTitle($subjectItem->getTitle());
        if (empty($subject)) {
            $subject = new Subject();
            $subject->setTitle($subjectItem->getTitle());
        }

        $subject->setParentSubject($parentSubject);

        $entityManager->persist($subject);
        $entityManager->flush();

        return $subject;
    }

}
