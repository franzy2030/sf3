<?php

namespace VoitureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use VoitureBundle\Entity\Marque;
use VoitureBundle\Entity\Voiture; 
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\DateType; 
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Component\HttpFoundation\Request;

class VoitureController extends Controller
{
    /**      
     * @Route("/addMarque/{nom}")      
     */

    public function addMarqueAction($nom)    
    {         
        $m= new Marque();         
        $m->setNomMarque($nom);                  
        $em=$this->getDoctrine()->getManager(); 
              
        $em->persist($m);         
        $em->flush(); 
         
                
        return $this ->render('VoitureBundle:Default:addMarque.html.twig',array('marque' => $m));     
    }

    /**      * @Route("/addVoiture/")      */     
    public function addVoitureAction(Request $request)     
    {          
        $v=new Voiture();         
        //générer le formulaire         
        $form=$this->createFormBuilder($v)               
            ->add('numSerie',TextType::class) 
            ->add('dateMiseCircu',DateType::class)               
            ->add('marque',EntityType::class,array (                     
                  'class' => 'VoitureBundle:Marque',                     
                  'choice_label' => 'nomMarque',                     
                  'choice_value' =>'id')                     
                  )               
            ->add('Add',SubmitType::class)               
            ->getForm();         
        $form->handleRequest($request);         
        //tester si le formuaire est valide         
        if($form->isValid())         
        {             
            $em=$this->getDoctrine()->getManager();             
            $em->persist($v);             
            $em->flush();         
        }     
        
        $voitures = $this->getDoctrine()->getRepository("VoitureBundle:Voiture")->findAll();  
        return $this->render('VoitureBundle:Default:formvoiture.html.twig',array('f' => $form->createView(),'voitures'=> $voitures ));
     }  
     
     
     /**  
      * @Route("/listeVoitures", name="listeV")  
      */ 
     public function listeVoitureAction() 
     {     
         $voitures = $this->getDoctrine()->getRepository("VoitureBundle:Voiture")->findAll(); 
 
    return $this ->render('VoitureBundle:Default:listeVoiture.html.twig',array('voitures' => $voitures)); 
 
    } 

}
