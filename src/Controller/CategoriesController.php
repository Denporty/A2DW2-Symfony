<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categories;
use App\Form\CategoriesType;
use Symfony\Component\HttpFoundation\Request;


class CategoriesController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $entityManager, Request $request)
    {
    $categorie = new categories();
    $form=$this->createForm(CategoriesType::class,$categorie);
    //$categorie->setName($request->request->get('name'));
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()){
        $categorie=$form->getData();
        $entityManager->persist($categorie);
        $entityManager->flush();
        return $this->redirectToRoute('home');
    }
    
    $categoriesRepository = $this->getDoctrine()
    ->getRepository(Categories::class)
    ->findAll();

    

    dump($categoriesRepository);
        return $this->render('categories/index.html.twig', [
            'controller_name' => 'CategoriesController',
            'categories'=>$categoriesRepository,
            'form' => $form->createView()
        ]);
    }
}
