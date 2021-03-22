<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\This;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Recipe::class);
        $this->paginator = $paginator;
    }

    /**
     * Get all recipeListe  by search
     * @param SearchData $search
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */

     public function findSearch(SearchData $search): \Knp\Component\Pager\Pagination\PaginationInterface
     {
         $query = $this->getSearchQuery($search)->getQuery();
        return $this->paginator->paginate(
          $query,
          $search->page,
          15
        );
     }

    /**
     * @param SearchData $search
     * @return array
     */
    public  function findMinMax(SearchData $search): array
     {
         $result = $this->getSearchQuery($search, true)
             ->select('MIN(r.price) as minPrice', 'MAX(r.price) as maxPrice')
             ->getQuery()
             ->getScalarResult();
         return [(int)$result[0]['minPrice'], (int)$result[0]['maxPrice']];
     }


     private function getSearchQuery(SearchData $search, $ignorePrice  = false): QueryBuilder
     {
         $query = $this
             ->createQueryBuilder('r');
         //->select('c', 'r')
         //->join('r.idcategory', 'c');

         if(!empty($search->q)) {
             $query = $query
                 ->andWhere('r.name Like :q')
                 ->setParameter('q', "%{$search->q}%");
         }

         if(!empty($search->minPrice) && $ignorePrice === false) {
             $query = $query
                 ->andWhere('r.price >= :minPrice')
                 ->setParameter('minPrice', "%{$search->minPrice}%");
         }
         if(!empty($search->maxPrice) && $ignorePrice === false) {
             $query = $query
                 ->andWhere('r.price >= :maxPrice')
                 ->setParameter('maxPrice', "%{$search->maxPrice}%");
         }

         if (!empty($search->categories)) {
             $query = $query
                 ->andWhere('c.idCategory IN (:categories)')
                 ->setParameter('categories', $search->categories);
         }
          return $query;
     }
}
