<?php

namespace Freelance\BlogBundle\AdminList;

use Doctrine\ORM\QueryBuilder;
use Kunstmaan\ArticleBundle\AdminList\AbstractArticlePageAdminListConfigurator;

/**
 * The AdminList configurator for the ArticlePage
 */
class ArticlePageAdminListConfigurator extends AbstractArticlePageAdminListConfigurator
{
    /**
     * Return current bundle name.
     *
     * @return string
     */
    public function getBundleName()
    {
        return 'FreelanceBlogBundle';
    }

    /**
     * Return current entity name.
     *
     * @return string
     */
    public function getEntityName()
    {
	return 'Pages\ArticlePage';
    }

    /**
     * @param QueryBuilder $queryBuilder The query builder
     */
    public function adaptQueryBuilder(QueryBuilder $queryBuilder)
    {
        parent::adaptQueryBuilder($queryBuilder);

	    $queryBuilder->setParameter('class', 'Freelance\BlogBundle\Entity\Pages\ArticlePage');
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getOverviewPageRepository()
    {
	    return $this->em->getRepository('FreelanceBlogBundle:Pages\ArticleOverviewPage');
    }

    /**
     * @return string
     */
    public function getListTemplate()
    {
	    return 'FreelanceBlogBundle:AdminList/ArticlePageAdminList:list.html.twig';
    }
}
