<?php

namespace App\Controller\back;
use App\Entity\DataGraph;
use App\Form\DataType;
use App\Form\ManagedataType;
use Doctrine\Persistence\ManagerRegistry;
use Shuchkin\SimpleXLSX;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class DataController extends AbstractController
{

    #[Route('/upload', name: 'app_upload')]
    public function upload()
    {
        return $this->renderForm('back/data/index.html.twig', []);
    }
}
