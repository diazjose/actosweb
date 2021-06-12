<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CajaController extends AbstractController
{
    /**
     * @Route("/caja", name="caja")
     */
    public function index(): Response
    {
        return $this->render('caja/index.html.twig', [
            'controller_name' => 'CajaController',
        ]);
    }
}
