<?php

namespace App\Controller\Admin;

use App\Entity\Report;
use App\Entity\User;
use App\Form\ReportType;
use App\Repository\ReportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/report')]
class ReportController extends AbstractController
{
    #[Route('/', name: 'admin_report_index', methods: ['GET'])]
    public function index(ReportRepository $reportRepository): Response
    {
        return $this->render('admin/report/index.html.twig', [
            'reports' => $reportRepository->findAll()
        ]);
    }

    #[Route('/new', name: 'admin_report_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $report = new Report();
        $form = $this->createForm(ReportType::class, $report);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $report->setCreatedAt();
            $entityManager->persist($report);
            $entityManager->flush();

            return $this->redirectToRoute('admin_report_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/report/new.html.twig', [
            'report' => $report,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_report_show', methods: ['GET'])]
    public function show(Report $report): Response
    {
        return $this->render('admin/report/show.html.twig', [
            'report' => $report,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_report_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Report $report, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReportType::class, $report);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_report_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/report/edit.html.twig', [
            'report' => $report,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_report_delete', methods: ['POST'])]
    public function delete(Request $request, Report $report, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$report->getId(), $request->request->get('_token'))) {
            $entityManager->remove($report);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_report_index', [], Response::HTTP_SEE_OTHER);
    }
}
