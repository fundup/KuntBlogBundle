<?php

namespace Freelance\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use \Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/")
     */
    public function indexAction()
    {
        return new RedirectResponse('/' . $this->container->getParameter('locale'));
    }
    
}
