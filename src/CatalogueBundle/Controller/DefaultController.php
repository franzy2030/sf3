<?php

namespace CatalogueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('CatalogueBundle:Default:index.html.twig');
    }

    /**
     * @Route("test/{name}")
     */
    public function helloAction($name)
    {
        return $this->render('CatalogueBundle:Default:index.html.twig',array('name'=>$name));
    }

    
    /**
     * @Route("/somme/{a}/{b}")
     */
    public function sommecAtion($a,$b)
    {
        $s=$a +$b;
        return $this->render('CatalogueBundle:Default:somme.html.twig',array('a'=>$a,'b'=>$b,'somme'=>$s));
    }
}
