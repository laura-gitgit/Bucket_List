<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function home(): Response
    {
        $date = new \DateTime();
        return $this->render('main/home.html.twig', [
            'today' => $date
        ]);
    }

    #[Route('/about', name: 'main_about')]
    public function about() : Response
    {
        $data = file_get_contents('../data/team.json');
        $team = json_decode($data, true);

        return $this->render('main/aboutus.html.twig',
        [
            'team' => $team
        ]);
    }

}
