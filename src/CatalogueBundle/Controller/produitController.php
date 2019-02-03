<?php

namespace CatalogueBundle\Controller;

use CatalogueBundle\Entity\Produit; 
use Symfony\Bundle\FrameworkBundle\Controller\Controller; 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Component\HttpFoundation\Request;
class produitController extends Controller
{
    /**      
      *  @Route("/addProduit/{nom}/{prix}")     
      */    
    public function addProduitAction($nom,$prix)    
    {    
        $p= new  Produit();        
        $p->setNom($nom);        
        $p->setPrix($prix);       
        $em=$this->getDoctrine()->getManager();        
        $em->persist($p);         
        $em->flush(); 
 
        return $this->render('CatalogueBundle:Default:addProduit.html.twig',array('produit'=>$p));    
    }

    /**  
      * @Route("hello/listeProduits", name="liste") 
      */ 
    public function listeProduitAction() 
    {    
         $produits = $this->getDoctrine()->getRepository("CatalogueBundle:Produit")->findAll(); 
 
        return $this->render('CatalogueBundle:Default:listeProduit.html.twig',array('produits'=>$produits)); 
 
    } 

    /** 
      * @Route("test/formProduit") 
      */ 
    public function formProduitAction(Request $request) 
    {    
        $p=new Produit();   
        //générer le formulaire     
        $form=$this->createFormBuilder($p)           
            ->add('nom',TextType::class)           
            ->add('prix',TextType::class)           
            ->add('Add',SubmitType::class)           
            ->getForm();     
        $form->handleRequest($request);    
        //tester si le formuaire est valide     
        if($form->isValid())     
        {         
            $em=$this->getDoctrine()->getManager();         
            $em->persist($p);         
            $em->flush();         
            //aller à la vue liste des produits         
            return $this->redirect($this->generateUrl("liste")); 
 
        } 
        return $this->render('CatalogueBundle:Default:formProduit.html.twig',array('f' => $form->createView())); 
    }

    
  
}
