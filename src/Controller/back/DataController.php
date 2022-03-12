<?php

namespace App\Controller\back;
use App\Entity\DataGraph;
use App\Entity\Report;
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
use Symfony\Component\Validator\Constraints\DateTime;

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
    public function save_file(ManagerRegistry $doctrine)
    {

        $entityManager = $doctrine->getManager();

        $client = $entityManager->getRepository(User::class)->find($_POST["user_id"]);

        $report = new Report();
        $date =  date("Ymd");
        $report->setName("rapport_". $date ."_". $_POST["user_id"]);
        $report->setUser($client);
        $report->setCreatedAt("2022-08-14");

        $entityManager->persist($report);
        $entityManager->flush();

        $lastId = $report->getId();

        move_uploaded_file(
            $_FILES['pdf']['tmp_name'],
            $this->getParameter('report_upload').'/'."rapport_$lastId.pdf"
        );

        return new JsonResponse($lastId);
    }
}
