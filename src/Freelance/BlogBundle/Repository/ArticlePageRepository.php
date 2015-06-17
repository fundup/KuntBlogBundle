<?php

namespace Freelance\BlogBundle\Repository;

use Doctrine\ORM\Query;
use Kunstmaan\ArticleBundle\Repository\AbstractArticlePageRepository;

/**
 * Repository class for the ArticlePage
 */
class ArticlePageRepository extends AbstractArticlePageRepository
{

    /**
     * Get articles by category
     * @param null $lang
     * @param null $offset
     * @param null $limit
     * @param $category
     * @return array
     */
    public function getArticlesByCategory($lang = null, $offset = null, $limit = null, $category) {
        $qb = $this->getArticlesQueryBuilder($lang, $offset, $limit);
        $qb->andWhere('a.category =:category');
        $qb->setParameter('category', $category);

        return $qb->getQuery()->getResult();
    }

    /**
     * Returns an array of all ArticlePages
     *
     * @param string $lang
     * @param int    $offset
     * @param int    $limit
     *
     * @return array
     */
    public function getArticles($lang = null, $offset = null, $limit = null)
    {
        $q = $this->getArticlesQuery($lang, $offset, $limit);

        return $q->getResult();
    }

    /**
     * Returns the article query
     *
     * @param string $lang
     * @param int    $offset
     * @param int    $limit
     *
     * @return Query
     */
    public function getArticlesQuery($lang = null, $offset, $limit)
    {
        $qb = $this->getArticlesQueryBuilder($lang, $offset, $limit);
        return $qb->getQuery();
    }

    /**
     * Return query builder
     * @param null $lang
     * @param $offset
     * @param $limit
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getArticlesQueryBuilder($lang = null, $offset, $limit) {
        $qb = $this->createQueryBuilder('a')
            ->innerJoin('KunstmaanNodeBundle:NodeVersion', 'v', 'WITH', 'a.id = v.refId')
            ->innerJoin('KunstmaanNodeBundle:NodeTranslation', 't', 'WITH', 't.publicNodeVersion = v.id')
            ->innerJoin('KunstmaanNodeBundle:Node', 'n', 'WITH', 't.node = n.id')
            ->where('t.online = 1')
            ->andWhere('n.deleted = 0')
            ->andWhere('v.refEntityName = :refname')
            ->orderBy('a.date', 'DESC')
            ->setParameter('refname', "Freelance\\BlogBundle\\Entity\\Pages\\ArticlePage");

        if (!is_null($lang)) {
            $qb->andWhere('t.lang = :lang')
                ->setParameter('lang', $lang);
        }

        if ($limit) {
            $qb->setMaxResults(1);

            if ($offset) {
                $qb->setFirstResult($offset);
            }
        }
        return $qb;
    }

}
