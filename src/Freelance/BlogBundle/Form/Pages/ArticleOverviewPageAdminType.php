<?php

namespace Freelance\BlogBundle\Form\Pages;

use Kunstmaan\ArticleBundle\Form\AbstractArticleOverviewPageAdminType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * The admin type for Articleoverview pages
 */
class ArticleOverviewPageAdminType extends AbstractArticleOverviewPageAdminType
{
    /**
     * Sets the default options for this type.
     *
     * @param OptionsResolverInterface $resolver The resolver for the options.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
	    'data_class' => 'Freelance\BlogBundle\Entity\Pages\ArticleOverviewPage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
	return 'article_overview_page_type';
    }
}
