<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: '_category')]
    public function create(EntityManagerInterface $em, Request $request): Response
    {
        $category = new Category();
        $categoryForm = $this->createForm(CategoryType::class);
        $categoryForm->handleRequest($request);

        if($categoryForm->isSubmitted() && $categoryForm->isValid()){
            $em->persist($category);
            $em->flush();
        }
        return $this->render('wish/create.html.twig', compact('categoryForm'));
    }
}
