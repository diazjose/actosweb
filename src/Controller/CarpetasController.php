<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarpetasController extends AbstractController
{
    /**
     * @Route("/carpetas", name="carpetas")
     */
    public function index(): Response
    {
        return $this->render('carpetas/index.html.twig', [
            'controller_name' => 'CarpetasController',
        ]);
    }
}
