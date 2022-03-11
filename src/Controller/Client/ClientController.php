<?php

namespace App\Controller\Client;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Security;

class ClientController extends AbstractController
{
    #[Route('/client', name: 'client_dashboard')]
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }
    #[Route('/client/account', name: 'client_account')]
    public function client_account(): Response
    {
        return $this->render('client/account.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
    #[Route('/client/report', name: 'client_report')]
    public function client_report(UserRepository $userRepo): Response
    {
       dump($this->getUser()->getId());
        return $this->render('client/report.html.twig', [
            'reports' => $userRepo->find($this->getUser()->getId())->getReports(),
        ]);
    }
}
