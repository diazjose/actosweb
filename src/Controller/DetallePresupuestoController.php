<?php

namespace App\Controller;

use App\Entity\DetallePresupuesto;
use App\Form\DetallePresupuestoType;
use App\Repository\DetallePresupuestoRepository; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/presupuesto/detalle")
 */
class DetallePresupuestoController extends AbstractController
{
    /**
     * @Route("/", name="detalle_index", methods={"GET","POST"})
     */
    public function index(Request $request): Response
    {
        $detalle = new DetallePresupuesto();
        $form = $this->createForm(DetallePresupuestoType::class, $detalle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $date = new \DateTime();
            $detalle->setCreatedAt($date);
            $detalle->setUpdatedAt($date);
            $entityManager->persist($detalle);
            $entityManager->flush();
            $this->addFlash('success', '!Detalle agregado correctamente!');
            return $this->redirectToRoute('detalle_index');
            
        }
        $em = $this->getDoctrine()->getManager();
        $detalles = $em->getRepository(DetallePresupuesto::class)->findAll();  

        return $this->render('detalle_presupuesto/index.html.twig', [
            'detalles' => $detalles,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="detalle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DetallePresupuesto $detalle, DetallePresupuestoRepository $detalleRepository): Response
    {        
        if ($this->isCsrfTokenValid('edit'.$detalle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            if($request->request->get('nombreViejo') != $request->request->get('nombre')){
                $de = $detalleRepository->findNombre($request->request->get('nombre'));
                if($de){
                    $this->addFlash('danger', '¡'.$request->request->get('nombre').' ya existe en la base de datos!');
                    return $this->redirectToRoute('detalle_index');        
                }else{
                    $detalle->setNombre($request->request->get('nombre'));
                }
            }
            $detalle->setPorcentaje($request->request->get('porcentaje'));
            $detalle->setValor($request->request->get('valor'));
            $entityManager->persist($detalle);
            $entityManager->flush();

            $this->addFlash('success', '¡Registro Actualizado correctamente!');
        }
        return $this->redirectToRoute('detalle_index');
    }
}
