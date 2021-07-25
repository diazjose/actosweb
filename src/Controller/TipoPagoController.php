<?php

namespace App\Controller;

use App\Entity\TipoPago;
use App\Form\TipoPagoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/tipo/pago")
 */
class TipoPagoController extends AbstractController
{
    /**
     * @Route("/", name="tipo_pago", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {
        $pago = new TipoPago();
        $form = $this->createForm(TipoPagoType::class, $pago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $date = new \DateTime();
            $pago->setCreatedAt($date);
            $pago->setUpdatedAt($date);
            $entityManager->persist($pago);
            $entityManager->flush();
            $this->addFlash('success', '!Tipo de Pago agregado correctamente!');
            return $this->redirectToRoute('tipo_pago');
            
        }
        $em = $this->getDoctrine()->getManager();
        $tipos = $em->getRepository(TipoPago::class)->findAll();  

        return $this->render('tipo_pago/index.html.twig', [
            'tipos' => $tipos,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="tipo_pago_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoPago $tipoPago): Response
    {
        if ($this->isCsrfTokenValid('edit'.$tipoPago->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $tipoPago->setNombre($request->request->get('nombre'));
            $entityManager->persist($tipoPago);
            $entityManager->flush();

            $this->addFlash('success', '¡Registro Actualizado correctamente!');
        }
        return $this->redirectToRoute('tipo_pago');
    }
}
