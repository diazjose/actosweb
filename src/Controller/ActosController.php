<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/actos")
 */
class ActosController extends AbstractController
{
    /**
     * @Route("/", name="actos")
     */
    public function index(): Response
    {
        return $this->render('actos/index.html.twig', [
            'controller_name' => 'ActosController',
        ]);
    }
}
