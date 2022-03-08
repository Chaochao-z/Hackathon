<?php

namespace App\Controller\front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $contents = $this->renderView('index.html.twig', [
            'category' => '...',
            'promotions' => ['...', '...'],
        ]);

        return new Response($contents);
    }
}
