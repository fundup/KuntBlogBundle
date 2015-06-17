<?php

namespace Freelance\BlogBundle\AdminList;

use Kunstmaan\ArticleBundle\AdminList\AbstractArticleAuthorAdminListConfigurator;
use Kunstmaan\AdminListBundle\AdminList\FilterType\ORM\StringFilterType;

/**
 * The AdminList configurator for the ArticleAuthor
 */
class ArticleCategoryAdminListConfigurator extends AbstractArticleAuthorAdminListConfigurator
{

    /**
     * Configure filters
     */
    public function buildFilters()
    {
        $this->addFilter('name', new StringFilterType('name'), 'Name');
        $this->addFilter('slug', new StringFilterType('slug'), 'Slug');
    }

    /**
     * Configure the visible columns
     */
    public function buildFields()
    {
        $this->addField('name', 'Name', true);
        $this->addField('slug', 'Slug', true);
    }

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
	return 'ArticleCategory';
    }
}
