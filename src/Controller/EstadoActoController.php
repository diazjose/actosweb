<?php

namespace App\Controller;

use App\Entity\EstadoActo;
use App\Form\EstadoActoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/estado/acto")
 */
class EstadoActoController extends AbstractController
{
    /**
     * @Route("/", name="estado_acto", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {
        $estado = new EstadoActo();
        $form = $this->createForm(EstadoActoType::class, $estado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $date = new \DateTime();
            $estado->setCreatedAt($date);
            $estado->setUpdatedAt($date);
            $entityManager->persist($estado);
            $entityManager->flush();
            $this->addFlash('success', '!Estado de Acto agregado correctamente!');
            
        }
        $em = $this->getDoctrine()->getManager();
        $tipos = $em->getRepository(EstadoActo::class)->findAll();  

        return $this->render('estado_acto/index.html.twig', [
            'tipos' => $tipos,
            //'concepto' => $concepto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="estado_acto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EstadoActo $estadoActo): Response
    {
        if($this->isCsrfTokenValid('edit'.$estadoActo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $estadoActo->setNombre($request->request->get('nombre'));
            $entityManager->persist($estadoActo);
            $entityManager->flush();

            $this->addFlash('success', '¡Registro Actualizado correctamente!');
        }
        return $this->redirectToRoute('estado_acto');
    }
}
