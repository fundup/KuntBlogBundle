<?php

namespace Freelance\BlogBundle\Entity\Pages;

use Freelance\BlogBundle\Form\Pages\HomePageAdminType;
use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\NodeBundle\Controller\SlugActionInterface;
use Kunstmaan\NodeBundle\Entity\AbstractPage;
use Kunstmaan\NodeSearchBundle\Helper\SearchTypeInterface;
use Kunstmaan\PagePartBundle\Helper\HasPageTemplateInterface;
use Symfony\Component\Form\AbstractType;

/**
 * HomePage
 *
 * @ORM\Entity()
 * @ORM\Table(name="freelance_blogbundle_home_pages")
 */
class HomePage extends AbstractPage implements HasPageTemplateInterface, SlugActionInterface
{
    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new HomePageAdminType();
    }

    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array(
            array(
                'name'  => 'ContentPage',
                'class' => 'Freelance\BlogBundle\Entity\Pages\ContentPage'
            ),
            array(
                'name'  => 'BehatTestPage',
                'class' => 'Freelance\BlogBundle\Entity\Pages\BehatTestPage'
            ),
            array(
                'name' => 'News Overview Page',
                'class'=> 'Freelance\BlogBundle\Entity\Pages\ArticleOverviewPage'
            ),array(
                'name'  => 'ArticlePage',
                'class' => 'Freelance\BlogBundle\Entity\Pages\ArticlePage'
            )
        );
    }

    /**
     * @return string[]
     */
    public function getPagePartAdminConfigurations()
    {
		    return array('FreelanceBlogBundle:main');
	    }

    /**
     * {@inheritdoc}
     */
    public function getPageTemplates()
    {
	return array('FreelanceBlogBundle:homepage');
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
        return 'FreelanceBlogBundle:Pages\HomePage:view.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function getSearchType()
    {
	return 'Home';
    }

    public function getControllerAction()
    {
        return 'FreelanceBlogBundle:ArticleCategory:filterArticleByCategory';
    }
}
