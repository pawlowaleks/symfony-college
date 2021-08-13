<?php

namespace App\Repository;

use App\Engine\Entity\CourseItem;
use App\Entity\Course;
use App\Entity\Subject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Course|null find($id, $lockMode = null, $lockVersion = null)
 * @method Course|null findOneBy(array $criteria, array $orderBy = null)
 * @method Course[]    findAll()
 * @method Course[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Course::class);
    }

    // /**
    //  * @return Course[] Returns an array of Course objects
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


    public function findOneByTitle(string $title): ?Course
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.title = :val')
            ->setParameter('val', $title)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function saveCourseItem(CourseItem $courseItem): ?Course
    {
        $entityManager = $this->getEntityManager();
        $course = $this->findOneByTitle($courseItem->getTitle());
        if (empty($course)) {
            $course = new Course();
            $course->setTitle($courseItem->getTitle());
        }

        $subjectItem = $courseItem->getSubjectItem();
        if (!empty($subjectItem)) {
            $subject = $entityManager->getRepository(Subject::class)->findOneByTitle($subjectItem->getTitle());
            if (!empty($subject)) {
                $course->addSubject($subject);
            }
        }

        $entityManager->persist($course);
        $entityManager->flush();

        return $course;
    }

}
