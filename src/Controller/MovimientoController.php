<?php

namespace App\Controller;

use App\Entity\Acto;
use App\Entity\Movimiento;
use App\Entity\Hoja;
use App\Entity\TipoRol;
use App\Form\MovimientoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/actos/movimiento")
 */
class MovimientoController extends AbstractController
{
    /**
     * @Route("/new", name="mevimiento_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $movimiento = new Movimiento();
        $form = $this->createForm(MovimientoType::class, $movimiento);
        $form->handleRequest($request);
        $idActo = $request->get('id');
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            $acto = $entityManager->getRepository(Acto::class)->find($idActo);
            $date = new \DateTime();
            $movimiento->setActo($acto);
            $movimiento->setCreatedAt($date);
            $movimiento->setUpdatedAt($date);
            $entityManager->persist($movimiento);
            $entityManager->flush();

            $this->addFlash('success', '¡Registro agregado correctamente!');
            return $this->redirectToRoute('acto_show', ['id' => $idActo]);
            
        }
        
        return $this->render('movimiento/new.html.twig', [
            'movimiento' => $movimiento,
            'form' => $form->createView(),
            'acto' => $idActo,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="movimivento_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Movimiento $movimiento): Response
    {
        $form = $this->createForm(MovimientoType::class, $movimiento);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', '¡Movimiento actualizado correctamente!');

            return $this->redirectToRoute('acto_show', [
                'id' => $movimiento->getActo()->getId(),
            ]);
        }

        return $this->render('movimiento/edit.html.twig', [
            'movimiento' => $movimiento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="movimiento_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Movimiento $movimiento): Response
    {   
        $id = $movimiento->getActo()->getId();
        if ($this->isCsrfTokenValid('delete'.$movimiento->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($movimiento);
            $entityManager->flush();
            $this->addFlash('success', '¡Movimiento eliminado correctamente!');
        }

        return $this->redirectToRoute('acto_show', ['id' => $id]);
            
    }

}
