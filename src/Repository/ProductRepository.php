<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Product[]
     */
    public function FindNewProducts(): array
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.Pictures', 'i')
            ->andWhere('p.PublishedAt <= :now')
            ->setParameter('now', new \DateTime())
            ->andWhere('p.Discount is not null')
            ->orderBy('p.PublishedAt', 'ASC')
            ->groupBy('p.id')
            ->setMaxResults(8)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Product[]
     */
    Public function FindByCategory($slug): array
    {
        return $this->createQueryBuilder('p')
            //  ->select('p.Price', 'p.Title','p.EndAt', 'p.Slug','p.Discount', 'i.imageName', 'i.Alt')
            ->leftJoin('p.Pictures', 'i')
            ->innerJoin('p.Category', 'c')
            ->andWhere('c.Slug = :slug')
            ->setParameter('slug', $slug)
            ->orderBy('p.PublishedAt', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

}
