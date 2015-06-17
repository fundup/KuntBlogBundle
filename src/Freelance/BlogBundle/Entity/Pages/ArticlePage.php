<?php

namespace Freelance\BlogBundle\Entity\Pages;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\ArticleBundle\Entity\AbstractArticlePage;
use Kunstmaan\NodeBundle\Controller\SlugActionInterface;
use Kunstmaan\NodeBundle\Helper\RenderContext;
use Kunstmaan\NodeSearchBundle\Helper\SearchTypeInterface;
use Kunstmaan\PagePartBundle\Helper\HasPageTemplateInterface;
use Freelance\BlogBundle\Entity\ArticleAuthor;
use Freelance\BlogBundle\Form\Pages\ArticlePageAdminType;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;

/**
 * @ORM\Entity(repositoryClass="Freelance\BlogBundle\Repository\ArticlePageRepository")
 * @ORM\Table(name="freelance_blogbundle_article_pages")
 * @ORM\HasLifecycleCallbacks
 */
class ArticlePage extends AbstractArticlePage implements HasPageTemplateInterface, SlugActionInterface
{
    /**
     * @var ArticleAuthor
     *
     * @ORM\ManyToOne(targetEntity="Freelance\BlogBundle\Entity\ArticleAuthor")
     * @ORM\JoinColumn(name="article_author_id", referencedColumnName="id")
     */
    protected $author;

    /**
     * @var ArticleAuthor
     *
     * @ORM\ManyToOne(targetEntity="Freelance\BlogBundle\Entity\ArticleCategory")
     * @ORM\JoinColumn(name="article_category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @return ArticleAuthor
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param ArticleAuthor $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }


    public function setAuthor($author)
    {
	$this->author = $author;

	return $this;
    }

    public function getAuthor()
    {
	return $this->author;
    }

    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new ArticlePageAdminType();
    }

    /**
     * {@inheritdoc}
     */
    public function getSearchType()
    {
	return 'Article';
    }

    /**
     * @return array
     */
    public function getPagePartAdminConfigurations()
    {
	    return array('FreelanceBlogBundle:main', 'FreelanceBlogBundle:image');
    }

    /**
     * {@inheritdoc}
     */
    public function getPageTemplates()
    {
	    return array('FreelanceBlogBundle:articlepage');
    }

    public function getDefaultView()
    {
	return 'FreelanceBlogBundle:Pages/ArticlePage:view.html.twig';
    }

    /**
     * Before persisting this entity, check the date.
     * When no date is present, fill in current date and time.
     *
     * @ORM\PrePersist
     */
    public function _prePersist()
    {
        // Set date to now when none is set
        if ($this->date == null) {
            $this->setDate(new \DateTime());
        }
    }


    public function getControllerAction()
    {
        return 'FreelanceBlogBundle:ArticleCategory:getArticleAndCategory';
    }
}
