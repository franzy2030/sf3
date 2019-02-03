<?php

namespace filmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use filmBundle\Entity\categorie;

class CategorieController extends Controller
{
    /**
     * @Route("/categorie/ajout")
     */
    public function ajoutAction()
    {
        
        $categorie=new Categorie();
        $categorie->setNom('Moustik le Krismatic');

        $categorie1=new Categorie();
        $categorie1->setNom('Tomas NGuindjol');

        $categorie2=new Categorie();
        $categorie2->setNom('Bob le Bricoleur');

        $categorie3=new Categorie();
        $categorie3->setNom('Jireh DeJesus');

        $em=$this->getDoctrine()->getManager();         
        $em->persist($categorie);   
        $em->persist($categorie1); 
        $em->persist($categorie2); 
        $em->persist($categorie3);      
        $em->flush(); 

        return $this->render('filmBundle:Categorie:ajout.html.twig');
    }


     /**
     * @Route("/categorie")
     */
    public function afficheAction(){

        $em=$this->getDoctrine()->getManager();   
        $categories=$em-> getRepository('filmBundle:categorie') -> findAll();     
        return $this->render('filmBundle:Categorie:affiche.html.twig', array('catego'=>$categories));
    }
}