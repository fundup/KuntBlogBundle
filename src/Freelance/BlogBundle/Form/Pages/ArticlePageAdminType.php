<?php

namespace Freelance\BlogBundle\Form\Pages;

use Kunstmaan\ArticleBundle\Form\AbstractArticlePageAdminType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * The admin type for Article pages
 */
class ArticlePageAdminType extends AbstractArticlePageAdminType
{
    /**
     * Builds the form.
     *
     * @param FormBuilderInterface $builder The form builder
     * @param array                $options The options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('author')
            ->add('category')
        ;
    }

    /**
     * Sets the default options for this type.
     *
     * @param OptionsResolverInterface $resolver The resolver for the options.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
	    'data_class' => 'Freelance\BlogBundle\Entity\Pages\ArticlePage'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
	return 'article_page_type';
    }
}
