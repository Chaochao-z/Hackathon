<?php

namespace App\Controller\front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route('/who-we-are', name: 'app_whoweare')]
    public function whoWeAreAction(): Response
    {
        return $this->render('front/about/whoweare.html.twig', [
            'controller_name' => 'AboutController',
        ]);
    }

    #[Route('/what-we-do', name: 'app_whatwedo')]
    public function whatWeDoAction(): Response
    {
        return $this->render('front/about/whatwedo.html.twig', [
            'controller_name' => 'AboutController',
        ]);
    }
}
