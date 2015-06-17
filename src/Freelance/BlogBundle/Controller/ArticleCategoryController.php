<?php

namespace Freelance\BlogBundle\Controller;

use Kunstmaan\AdminBundle\Helper\Security\Acl\Permission\PermissionMap;
use Kunstmaan\NodeBundle\Helper\NodeMenu;
use Kunstmaan\NodeBundle\Helper\RenderContext;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ArticleCategoryController extends Controller
{

    /**
     * @param Request $request
     * @param string $url
     * @param null $categorySlug
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function filterArticleByCategoryAction(Request $request, $url = 'articles', $categorySlug = null) {
        $articlePageRepository = $this->getDoctrine()
                                    ->getRepository('FreelanceBlogBundle:Pages\ArticlePage');

        $articleCategoryRepository = $this->getDoctrine()
                                    ->getRepository('FreelanceBlogBundle:ArticleCategory');

        //filtrer sur une categorie
        $currentUrl = $request->getUri();
        $sheme = $request->getSchemeAndHttpHost();
        $uri = str_replace($sheme.'/', '',$currentUrl);
        $fragments = explode('/', $uri);
        //redirection pour /categorie
        if(count($fragments) == 1 && $fragments[0] == 'categorie') {
            return $this->redirect('/');
        }
        if(count($fragments) > 1) {
            $categorySlug = $fragments[1];
        }
        if(is_null($categorySlug)) {
            $pages = $articlePageRepository->getArticles($request->getLocale());
        } else {
            $category = $articleCategoryRepository->findBySlug($categorySlug);
            //get articles for category
            $pages = $articlePageRepository->getArticlesByCategory($request->getLocale(),null,null, $category);
        }

        $adapter = new ArrayAdapter($pages);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(5);
        $pagenumber = $request->get('page');
        if (!$pagenumber || $pagenumber < 1) {
            $pagenumber = 1;
        }
        $pagerfanta->setCurrentPage($pagenumber);
        $context['pagerfanta'] = $pagerfanta;

        $categories = $articleCategoryRepository->findAll();
        $context['categories'] = $categories;

        $request->attributes->set('_renderContext',$context);
    }


    /**
     * @param Request $request
     */
    public function getArticleAndCategoryAction(Request $request) {
        $articleCategoryRepository = $this->getDoctrine()
            ->getRepository('FreelanceBlogBundle:ArticleCategory');
        $categories = $articleCategoryRepository->findAll();
        $context['categories'] = $categories;
        $request->attributes->set('_renderContext',$context);
    }
}
