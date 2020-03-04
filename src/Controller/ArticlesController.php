<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Articles;
use Symfony\Component\HttpFoundation\Request;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    public function index(Request $request){
    $article = new Articles();
    /*
    $form=$this->createForm(ArticlesType::class,$article);
    //$categorie->setName($request->request->get('name'));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()){
        $article=$form->getData();
        $entityManager->persist($article);
        $entityManager->flush();
        return $this->redirectToRoute('articlehome');
    }*/
    
    $articlesRepository = $this->getDoctrine()
    ->getRepository(Articles::class)
    ->findAll();

    

    dump($articlesRepository);
        return $this->render('articles/index.html.twig', [
            'controller_name' => 'ArticlesController',
            'articles'=>$articlesRepository,
        ]);
    }
}
