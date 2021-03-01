<?php

namespace App\Controller;

use App\Entity\Job;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="job_opportunities", methods={"GET"})
     */
    public function index(JobRepository $jobRepository): Response
    {
        return $this->render('job/opportunities.html.twig', [
            //'jobs' => $jobRepository->findAll(),
            'jobs' => $jobRepository->findBy(['status' => 'visible']),
        ]);
    }
}