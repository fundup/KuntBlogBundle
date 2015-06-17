<?php

namespace Freelance\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\ArticleBundle\Entity\AbstractAuthor;
use Freelance\BlogBundle\Form\ArticleAuthorAdminType;
use Symfony\Component\Form\AbstractType;

/**
 * The author for a Article
 *
 * @ORM\Entity()
 * @ORM\Table(name="freelance_blogbundle_article_authors")
 */
class ArticleAuthor extends AbstractAuthor
{
    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getAdminType()
    {
        return new ArticleAuthorAdminType();
    }
}