<?php

namespace Freelance\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Repository class for ArticleCategory
 */
class ArticleCategoryRepository extends EntityRepository
{
    public function findBySlug($categorySlug) {
        return $this->findBy(['slug'=>$categorySlug]);
    }

    /**
     * @return array
     */
    public function findAllCategory()
    {
        return $this->findAll();
    }
}