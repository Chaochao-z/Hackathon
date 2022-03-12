<?php

namespace App\Controller\back;
use App\Entity\DataGraph;
use App\Entity\User;
use App\Form\DataType;
use App\Form\ManagedataType;
use Doctrine\Persistence\ManagerRegistry;
use Shuchkin\SimpleXLSX;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class DataController extends AbstractController
{

    #[Route('/upload', name: 'app_upload')]
    public function upload(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $clients = $entityManager->getRepository(User::class)->findAll();

        return $this->renderForm('back/data/index.html.twig', [
            'clients' => $clients
        ]);
    }

    #[Route('/save-file', name: 'app_save_file')]
    public function save_file()
    {
        move_uploaded_file(
            $_FILES['pdf']['tmp_name'],
            $this->getParameter('report_upload').'/'."test4.pdf"
        );

        return new JsonResponse($_POST);
    }
}
