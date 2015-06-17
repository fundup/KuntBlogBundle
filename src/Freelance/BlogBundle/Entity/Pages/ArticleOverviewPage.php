<?php

namespace Freelance\BlogBundle\Entity\Pages;

use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\NodeSearchBundle\Helper\SearchTypeInterface;
use Kunstmaan\PagePartBundle\Helper\HasPageTemplateInterface;
use Freelance\BlogBundle\Form\Pages\ArticleOverviewPageAdminType;
use Kunstmaan\ArticleBundle\Entity\AbstractArticleOverviewPage;
use Kunstmaan\NodeBundle\Helper\RenderContext;
use Kunstmaan\PagePartBundle\PagePartAdmin\AbstractPagePartAdminConfigurator;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Kunstmaan\NodeBundle\Controller\SlugActionInterface;

/**
 * The article overview page which shows its articles
 *
 * @ORM\Entity(repositoryClass="Freelance\BlogBundle\Repository\ArticleOverviewPageRepository")
 * @ORM\Table(name="freelance_blogbundle_article_overview_pages")
 */
class ArticleOverviewPage extends AbstractArticleOverviewPage implements HasPageTemplateInterface,SlugActionInterface
{
    /**
     * @return AbstractPagePartAdminConfigurator[]
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
	    return array('FreelanceBlogBundle:articleoverviewpage');
    }

    public function getArticleRepository($em)
    {
	    return $em->getRepository('FreelanceBlogBundle:Pages\ArticlePage');
    }

    /**
     * @return string
     */
    public function getDefaultView()
    {
	    return 'FreelanceBlogBundle:Pages/ArticleOverviewPage:view.html.twig';
    }

    /**
     * {@inheritdoc}
     */
    public function getSearchType()
    {
	    return 'Article';
    }

    /**
     * Returns the default backend form type for this page
     *
     * @return AbstractType
     */
    public function getDefaultAdminType()
    {
        return new ArticleOverviewPageAdminType();
    }
    /**
     * @return array
     */
    public function getPossibleChildTypes()
    {
        return array (
            array(
                'name'  => 'ArticleOverviewPage',
                'class' => 'Freelance\BlogBundle\Entity\Pages\ArticleOverviewPage'
            ),array(
                'name'  => 'ArticlePage',
                'class' => 'Freelance\BlogBundle\Entity\Pages\ArticlePage'
            ),
        );
    }


    /**
     * Récupérer les catégories des articles
     * {@inheritdoc}
     */
//    public function service(ContainerInterface $container, Request $request, RenderContext $context)
//    {
//        parent::service($container, $request, $context);
//        $em = $container->get('doctrine')->getManager();
//        $articleCategoryRepository = $em->getRepository('FreelanceBlogBundle:ArticleCategory');
//        $articlePageRepository = $em->getRepository('FreelanceBlogBundle:Pages\ArticlePage');
//
//        $categories = $articleCategoryRepository->findAll();
//        $context['categories'] = $categories;
//        /**
//         * On pourrait créer un nouveau pageType ArticleByCategoryOverview pour mettre ca
//         * créer un service pour partager du code...
//         */
//        //filtrer sur une categorie
//        $currentUrl = $request->getUri();
//        $sheme = $request->getSchemeAndHttpHost();
//        $uri = str_replace($sheme.'/', '',$currentUrl);
//        $fragments = explode('/', $uri);
//        if(count($fragments) > 1) {
//            $categorySlug = $fragments[1];
//            //get article from categoryslug
//            $category = $articleCategoryRepository->findBySlug($categorySlug);
//            $pages = $articlePageRepository->getArticlesByCategory($request->getLocale(),null,null, $category);
//            $adapter = new ArrayAdapter($pages);
//            $pagerfanta = new Pagerfanta($adapter);
//            $pagerfanta->setMaxPerPage(5);
//
//            $pagenumber = $request->get('page');
//            if (!$pagenumber || $pagenumber < 1) {
//                $pagenumber = 1;
//            }
//            $pagerfanta->setCurrentPage($pagenumber);
//            $context['pagerfanta'] = $pagerfanta;
//        }
//
//    }

    public function getControllerAction()
    {
        return 'FreelanceBlogBundle:ArticleCategory:filterArticleByCategory';
    }
}
