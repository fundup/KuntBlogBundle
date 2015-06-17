<?php

namespace Freelance\BlogBundle\Entity\PageParts;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * RawHtmlPagePart
 *
 * @ORM\Table(name="freelance_blogbundle_raw_html_page_parts")
 * @ORM\Entity
 */
class RawHtmlPagePart extends AbstractPagePart
{
    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank()
     */
    protected $content;

    /**
     * @return string
     */
    public function getContent()
    {
	return $this->content;
    }

    /**
     * @param string $content
     *
     * @return RawHtmlPagePart
     */
    public function setContent($content)
    {
	$this->content = $content;

	return $this;
    }

    /**
     * Get the twig view.
     *
     * @return string
     */
    public function getDefaultView()
    {
	return 'FreelanceBlogBundle:PageParts:RawHtmlPagePart/view.html.twig';
    }

    /**
     * Get the admin form type.
     *
     * @return \Freelance\BlogBundle\Form\PageParts\RawHtmlPagePartAdminType
     */
    public function getDefaultAdminType()
    {
	return new \Freelance\BlogBundle\Form\PageParts\RawHtmlPagePartAdminType();
    }
}
