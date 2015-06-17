<?php

namespace Freelance\BlogBundle\AdminList;

use Kunstmaan\ArticleBundle\AdminList\AbstractArticleAuthorAdminListConfigurator;

/**
 * The AdminList configurator for the ArticleAuthor
 */
class ArticleAuthorAdminListConfigurator extends AbstractArticleAuthorAdminListConfigurator
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
	return 'ArticleAuthor';
    }
}
