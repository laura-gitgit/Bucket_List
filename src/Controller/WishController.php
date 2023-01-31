<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wish', name: 'wish')]
class WishController extends AbstractController
{

    #[Route('/', name: '_wishes')]
    public function wishes(): Response
    {
        //TODO : récupérer la liste de souhaits
        return $this->render('wish/list.html.twig', [ ]);
    }

    #[Route('/{id}', name: '_wish', requirements: ['id' => '\d+'])]
    public function wish(int $id): Response
    {
        //TODO : récupérer le détail d'un souhait
        return $this->render('wish/detail.html.twig',
            [
                'id' => $id
            ]);
    }


}
