<?php

namespace App\Controller;

use App\Entity\LugarActo;
use App\Form\LugarActoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/lugar/acto")
 */
class LugarActoController extends AbstractController
{
    /**
     * @Route("/", name="lugar_acto", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {
        $lugar = new LugarActo();
        $form = $this->createForm(LugarActoType::class, $lugar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $date = new \DateTime();
            $lugar->setCreatedAt($date);
            $lugar->setUpdatedAt($date);
            $entityManager->persist($lugar);
            $entityManager->flush();
            $this->addFlash('success', '!Lugar agregado correctamente!');
            
        }
        $em = $this->getDoctrine()->getManager();
        $lugares = $em->getRepository(LugarActo::class)->findAll();  

        return $this->render('lugar_acto/index.html.twig', [
            'lugares' => $lugares,
            //'concepto' => $concepto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="lugar_acto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LugarActo $lugarActo): Response
    {
        if($this->isCsrfTokenValid('edit'.$lugarActo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $lugarActo->setNombre($request->request->get('nombre'));
            $entityManager->persist($lugarActo);
            $entityManager->flush();

            $this->addFlash('success', '¡Registro Actualizado correctamente!');
        }
        return $this->redirectToRoute('lugar_acto');
    }
}
