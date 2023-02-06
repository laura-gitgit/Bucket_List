<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wish', name: 'wish')]
class WishController extends AbstractController
{

    #[Route('/', name: '_wishes')]
    public function wishes(WishRepository $wishRepository): Response
    {
        $wishes = $wishRepository->findBy([], ["dateCreated" => "DESC"]);

        return $this->render('wish/list.html.twig', compact('wishes'));
    }

    #[Route('/{id}', name: '_wish', requirements: ['id' => '\d+'])]
    public function wish(int $id, WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->findOneBy(['id' => $id]);
        return $this->render('wish/detail.html.twig',
            [
                'id' => $id,
                'wish' => $wish
            ]);
    }

    #[Route('/create', name: '_create')]
    public function createWish(EntityManagerInterface $em, Request $request) :Response
    {
        $wish = new Wish();
        $wishForm = $this->createForm(WishType::class, $wish);
        $wishForm->handleRequest($request);
        if($wishForm->isSubmitted() ){
            try {
                $wish->setIsPublished(true);
                $wish->setDateCreated(new \DateTime());
                if($wishForm->isValid()){
                    $em->persist($wish);
                }
            }catch (\Exception $exception){
                dd($exception->getMessage());
            }
            $em->flush();
            $this->addFlash('success', 'Wish created');
            return $this->redirectToRoute('wish_wish', ["id" => $wish->getId()]);
        }
        return $this->render('wish/create.html.twig', compact('wishForm'));
    }

}
