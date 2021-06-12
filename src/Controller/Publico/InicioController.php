<?php

namespace App\Controller\Publico;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InicioController extends AbstractController
{
    /**
     * @Route("/", name="publico_inicio")
     */
    public function index()
    {
        //return $this->render('publico/inicio/login.html.twig', []);
        return $this->redirectToRoute('fos_user_security_login');
    }

    /**
     * Sirve para redireccionar al usuario a la dirección más adecuada 
     * cuando se desconoce su destino principal 
     * 
     * @Route("/redireccionar/", name="publico_redireccionar")
     */
    public function redireccionar()
    {
        if ($this->getUser() && $this->getUser()->getId()) return $this->redirectToRoute('inicio');

        return $this->redirectToRoute('publico_inicio');
    }    
}
