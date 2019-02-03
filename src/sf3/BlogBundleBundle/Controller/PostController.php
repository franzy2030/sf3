<?php

namespace sf3\BlogBundleBundle\Controller;

use Doctrine\DBAL\Types\TextType;
use sf3\BlogBundleBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Post controller.
 *
 */
class PostController extends Controller
{
    /**
     * Lists all post entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $postslist = $em->getRepository('blogBundle:Post')->findAll();


        $posts  = $this->get('knp_paginator')->paginate(
        $postslist,
        $request->query->getInt('page', 1)/*page number*/,
        4/*limit per page*/
        );

        return $this->render('post/index.html.twig', array(
            'posts' => $posts,

        ));
    }

    /**
     * Creates a new post entity.
     *
     */
    public function newAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm('sf3\BlogBundleBundle\Form\PostType', $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $this->addFlash('message','Post created successfully');
            return $this->redirectToRoute('post_show', array('id' => $post->getId()));
        }

        return $this->render('post/new.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a post entity.
     *
     */
    public function showAction(Post $post)
    {
        $deleteForm = $this->createDeleteForm($post);

        return $this->render('post/show.html.twig', array(
            'post' => $post,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays another post entity.
     *
     */
    public function showsAction(Post $post)
    {
        $deleteForm = $this->createDeleteForm($post);

        return $this->render('post/shows.html.twig', array(
            'post' => $post,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing post entity.
     *
     */
    public function editAction(Request $request, Post $post)
    {
        $deleteForm = $this->createDeleteForm($post);
        $editForm = $this->createForm('sf3\BlogBundleBundle\Form\PostType', $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('message','Updated Post successfully');

            return $this->redirectToRoute('post_index', array('id' => $post->getId()));
        }

        return $this->render('post/edit.html.twig', array(
            'post' => $post,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a post entity.
     *
     */
    public function deleteAction(Request $request, Post $post)
    {
        $form = $this->createDeleteForm($post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush();
            $this->addFlash('message','Deleted Post successfully');
        }

        return $this->redirectToRoute('post_index');
    }


    /**
     * Creates a form to delete a post entity.
     *
     * @param Post $post The post entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Post $post)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_delete', array('id' => $post->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    public function rechercheAction (Request $request){
        $em = $this ->getDoctrine()->getManager();
        $modeleslist = $em-> getRepository('blogBundle:Post')->findAll();

        $modeles = $this->get('knp_paginator')->paginate(
            $modeleslist,
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

       if ($request->isMethod('POST')){
           $motcle = $request->get('motcle');
           $modeleslist = $em->getRepository('blogBundle:Post')->findBy(array("title"=>$motcle));

           $modeles = $this->get('knp_paginator')->paginate(
               $modeleslist,
               $request->query->getInt('page', 1)/*page number*/,
               4/*limit per page*/
           );
       }


        return $this -> render('post/recherche.html.twig',array('modeles'=>$modeles,));
    }

    public function exportAction(){

        $em = $this ->getDoctrine()->getManager();
        $list = $em-> getRepository('blogBundle:Post')->findAll();

        #Writer
        $writer = $this->container->get('egyg33k.csv.writer');
        $csv = $writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['Id','Title','Content','Category']);
        foreach ($list as $list){
            $csv->insertOne([$list->getId(),$list->getTitle(),$list->getContent(),$list->getCategory()]);
        }
        $csv->output('posts.csv');
        exit;
    }


}
