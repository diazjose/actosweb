<?php

namespace App\Controller;

use App\Entity\TipoCaja;
use App\Form\TipoCajaType;
//use App\Repository\TipoCajaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/tipo/caja")
 */
class TipoCajaController extends AbstractController
{
    /**
     * @Route("/", name="tipo_caja", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {
        $concepto = new TipoCaja();
        $form = $this->createForm(TipoCajaType::class, $concepto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $date = new \DateTime();
            $concepto->setCreatedAt($date);
            $concepto->setUpdatedAt($date);
            $entityManager->persist($concepto);
            $entityManager->flush();
            $this->addFlash('success', '!Concepto agregado correctamente!');
            
        }
        $em = $this->getDoctrine()->getManager();
        $tipos = $em->getRepository(TipoCaja::class)->findAll();  

        return $this->render('tipo_caja/index.html.twig', [
            'tipos' => $tipos,
            //'concepto' => $concepto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="tipo_caja_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoCaja $tipoCaja): Response
    {
        if ($this->isCsrfTokenValid('edit'.$tipoCaja->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $tipoCaja->setNombre($request->request->get('nombre'));
            $entityManager->persist($tipoCaja);
            $entityManager->flush();

            $this->addFlash('success', '¡Registro Actualizado correctamente!');
        }
        return $this->redirectToRoute('tipo_caja');
    }
}
