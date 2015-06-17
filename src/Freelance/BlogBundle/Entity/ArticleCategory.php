<?php

namespace Freelance\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\AdminBundle\Entity\AbstractEntity;
use Freelance\BlogBundle\Form\ArticleCategoryAdminType;
use Symfony\Component\Form\AbstractType;

/**
 * The author for a Article
 *
 * @ORM\Entity(repositoryClass="Freelance\BlogBundle\Repository\ArticleCategoryRepository"))
 * @ORM\Table(name="freelance_blogbundle_article_category")
 */
class ArticleCategory extends AbstractEntity
{

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false, name="name")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false, name="slug")
     */
    protected $slug;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getAdminType()
    {
        return new ArticleCategoryAdminType();
    }
}