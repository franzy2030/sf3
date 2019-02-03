<?php

namespace filmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use filmBundle\Entity\categorie;
use filmBundle\Entity\acteur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\DateType; 
use Symfony\Bridge\Doctrine\Form\Type\EntityType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class ActeurController extends Controller
{
    // /**
    //  * @Route("/Acteur/ajout")
    //  */
    // public function ajoutAction()
    // {
        
    //     $Acteur = new Acteur();
       

    //     return $this->render('filmBundle:Acteur:ajout.html.twig');
    // }

    /**      * @Route("/addActeur/")      */     
    public function addActeurAction(Request $request)     
    {          
        $Acteur = new Acteur();
           
        //générer le formulaire         
        $form=$this->createFormBuilder($Acteur)               
            ->add('nomActeur',TextType::class)
            ->add('prenomActeur',TextType::class) 
            ->add('datenaissace',BirthdayType::class,array('format'=>'dd-MM-yyyy'))               
            ->add('sexe',ChoiceType::class,array('choices'=> array('H'=> 'Homme', 'F' => 'Femme'),'expanded'=>true                   
                  ) )                           
            ->getForm();         
        $form->handleRequest($request);         
        //tester si le formuaire est valide         
        if($form->isValid())         
        {             
            $em=$this->getDoctrine()->getManager();             
            $em->persist($Acteur);             
            $em->flush();         
        }     
        
        $acteurs = $this->getDoctrine()->getRepository("filmBundle:acteur")->findAll();  
        return $this->render('filmBundle:Acteur:ajout.html.twig',array('f' => $form->createView(),'acteurs'=> $acteurs ));
     }  
     

     /**      * @Route("/modif/{id}")      */     
    public function modifierrAction($id)     
    {    
        $message="Modifier un Acteur";  
        $em=$this->getDoctrine()->getManager();      
        $Acteur = $em ->getRepository('filmBundle:acteur')->find($id);
           
        //générer le formulaire         
        $form=$this->createFormBuilder($Acteur)               
            ->add('nomActeur',TextType::class)
            ->add('prenomActeur',TextType::class) 
            ->add('datenaissace',BirthdayType::class,array('format'=>'dd-MM-yyyy'))               
            ->add('sexe',ChoiceType::class,array('choices'=> array('H'=> 'Homme', 'F' => 'Femme'),'expanded'=>true                   
                  ) )                           
            ->getForm();
        $request = $this-> getRequest();
        if($request -> getMethod()=='POST'){

            $form->handleRequest($request);         
        //tester si le formuaire est valide         
            if($form->isValid())         
            {                        
            // $em->persist($Acteur);             
            $em->flush();     
            $message="Modification éffectuer avec Succès";        
            }     
        }
        
        $acteurs = $this->getDoctrine()->getRepository("filmBundle:acteur")->findAll();  
        return $this->render('filmBundle:Acteur:ajout.html.twig',array('f' => $form->createView(),'acteurs'=> $acteurs ));
     }  

}