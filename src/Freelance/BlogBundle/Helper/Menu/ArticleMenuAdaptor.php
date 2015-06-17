<?php

namespace Freelance\BlogBundle\Helper\Menu;

use Doctrine\ORM\EntityManager;
use Kunstmaan\AdminBundle\Helper\Menu\MenuAdaptorInterface;
use Kunstmaan\AdminBundle\Helper\Menu\MenuBuilder;
use Kunstmaan\AdminBundle\Helper\Menu\MenuItem;
use Kunstmaan\AdminBundle\Helper\Menu\TopMenuItem;
use Symfony\Component\HttpFoundation\Request;

class ArticleMenuAdaptor implements MenuAdaptorInterface
{
    private $overviewpageIds = array();

    /**
     * @param EntityManager $em The entity manager
     */
    public function __construct(EntityManager $em)
    {
	$overviewPageNodes = $em->getRepository('KunstmaanNodeBundle:Node')->findByRefEntityName('Freelance\\BlogBundle\\Entity\\Pages\\ArticleOverviewPage');
        foreach ($overviewPageNodes as $overviewPageNode) {
            $this->overviewpageIds[] = $overviewPageNode->getId();
        }
    }

    public function adaptChildren(MenuBuilder $menu, array &$children, MenuItem $parent = null, Request $request = null)
    {
        if (!is_null($parent) && 'KunstmaanAdminBundle_modules' == $parent->getRoute()) {
            // Page
            $menuItem = new TopMenuItem($menu);
            $menuItem
		->setRoute('freelanceblogbundle_admin_pages_articlepage')
		->setLabel('Article Pages')
                ->setUniqueId('Article')
                ->setParent($parent);
            if (stripos($request->attributes->get('_route'), $menuItem->getRoute()) === 0) {
                $menuItem->setActive(true);
                $parent->setActive(true);
            }
            $children[] = $menuItem;

            // Author
            $menuItem = new TopMenuItem($menu);
            $menuItem
		->setRoute('freelanceblogbundle_admin_articleauthor')
                ->setLabel('Article Authors')
                ->setUniqueId('Article Authors')
                ->setParent($parent);
            if (stripos($request->attributes->get('_route'), $menuItem->getRoute()) === 0) {
                $menuItem->setActive(true);
                $parent->setActive(true);
            }
            $children[] = $menuItem;

            // Ajout de Category au menu
            $menuItem = new TopMenuItem($menu);
            $menuItem
                ->setRoute('freelanceblogbundle_admin_articlecategory')
                    ->setLabel('Article Category')
                    ->setUniqueId('Article Category')
                    ->setParent($parent);
            if (stripos($request->attributes->get('_route'), $menuItem->getRoute()) === 0) {
                $menuItem->setActive(true);
                $parent->setActive(true);
            }
            $children[] = $menuItem;
        }

        //don't load children
        if (!is_null($parent) && 'KunstmaanNodeBundle_nodes_edit' == $parent->getRoute()) {
            foreach ($children as $key => $child) {
                if ('KunstmaanNodeBundle_nodes_edit' == $child->getRoute()){
                    $params = $child->getRouteParams();
                    $id = $params['id'];
                    if (in_array($id, $this->overviewpageIds)) {
                        $child->setChildren(array());
                    }
                }
            }
        }
    }
}
