<?php

namespace App\Controller;

use App\Entity\TipoActo;
use App\Form\TipoActoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/tipo/acto")
 */
class TipoActoController extends AbstractController
{
    /**
     * @Route("/", name="tipo_acto", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {
        $acto = new TipoActo();
        $form = $this->createForm(TipoActoType::class, $acto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $date = new \DateTime();
            $acto->setCreatedAt($date);
            $acto->setUpdatedAt($date);
            $entityManager->persist($acto);
            $entityManager->flush();
            $this->addFlash('success', '!Acto agregado correctamente!');
            return $this->redirectToRoute('tipo_acto');
            
        }
        $em = $this->getDoctrine()->getManager();
        $tipos = $em->getRepository(TipoActo::class)->findAll();  

        return $this->render('tipo_acto/index.html.twig', [
            'tipos' => $tipos,
            //'concepto' => $concepto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="tipo_acto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoActo $tipoActo): Response
    {
        if ($this->isCsrfTokenValid('edit'.$tipoCaja->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $tipoCaja->setNombre($request->request->get('nombre'));
            $entityManager->persist($tipoActo);
            $entityManager->flush();

            $this->addFlash('success', '¡Registro Actualizado correctamente!');
        }
        return $this->redirectToRoute('tipo_acto');
    }
}
