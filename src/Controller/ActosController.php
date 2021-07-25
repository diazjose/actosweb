<?php

namespace App\Controller;

use App\Entity\Acto;
use App\Entity\Persona;
use App\Entity\Hoja;
use App\Entity\TipoRol;
use App\Entity\TipoCaja;
use App\Entity\TipoPago;
use App\Repository\HojaRepository;
use App\Repository\ActosRepository;
use App\Form\ActoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/actos")
 */
class ActosController extends AbstractController
{
    /**
     * @Route("/", name="acto_index", methods={"GET"})
     */
    public function index(Request $request, ActosRepository $actosRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $actos = $em->getRepository(Acto::class)->findAll();       
        
        return $this->render('actos/index.html.twig', [
                'actos' => $actos,
            ]);       
    }

    /**
     * @Route("/new", name="acto_new", methods={"GET","POST"})
     */
    public function new(Request $request, HojaRepository $hojaRepository): Response
    {
        $acto = new Acto();
        $form = $this->createForm(ActoType::class, $acto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /* Descontar Stock de Hoja */ 
            $idHoja = $acto->getTipoActo()->getId();
            $hoja = $hojaRepository->findHoja($idHoja);            
            $cantidad = $hoja->getCantidad() - 1;
            $hoja->setCantidad($cantidad);
            /* Guardar consultar */
            $date = new \DateTime();
            $acto->setCreatedAt($date);
            $acto->setUpdatedAt($date);
            $entityManager->persist($acto);
            $entityManager->flush();
            $entityManager->persist($hoja);
            $entityManager->flush();

            $this->addFlash('success', '¡Registro agregado correctamente!');
            return $this->redirectToRoute('acto_index');
            
        }
        
        return $this->render('actos/new.html.twig', [
            'acto' => $acto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="acto_show", methods={"GET"})
     */
    public function show(Acto $acto): Response
    {
        $conceptos = $entityManager = $this->getDoctrine()->getManager()->getRepository(TipoCaja::class)->findAll();
        $tipos = $entityManager = $this->getDoctrine()->getManager()->getRepository(TipoPago::class)->findAll();
        return $this->render('actos/show.html.twig', [
            'acto' => $acto,
            'conceptos' => $conceptos,
            'tipos' => $tipos,
        ]);
    }
    
    /**
     * @Route("/edit/{id}", name="acto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Acto $acto, HojaRepository $hojaRepository): Response
    {
        $form = $this->createForm(ActoType::class, $acto);
        $form->handleRequest($request);
        $tipo = $request->get('tipo');
        if ($form->isSubmitted() && $form->isValid()) {
            
            if($tipo != $acto->getTipoActo()->getId()){

                $en = $this->getDoctrine()->getManager();
                $hoja = $hojaRepository->findHoja($tipo);
                $cantidad = $hoja->getCantidad() + 1;
                $hoja->setCantidad($cantidad);
                $en->persist($hoja);
                $en->flush();

                $hoja = $hojaRepository->findHoja($acto->getTipoActo()->getId());
                $cantidad = $hoja->getCantidad() - 1;
                $hoja->setCantidad($cantidad);
                $en->persist($hoja);
                $en->flush();

            }
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', '¡Registro actualizado correctamente!');

            return $this->redirectToRoute('acto_show', [
                'id' => $acto->getId(),
            ]);
        }

        return $this->render('actos/edit.html.twig', [
            'acto' => $acto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/acto_delete/{id}", name="acto_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Acto $acto, HojaRepository $hojaRepository): Response
    {   
        if ($this->isCsrfTokenValid('delete'.$acto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager = $this->getDoctrine()->getManager();
            $tipo = $request->get('tipo');
            $hoja = $hojaRepository->findHoja($tipo);
            $cantidad = $hoja->getCantidad() + 1;
            $hoja->setCantidad($cantidad);
            $entityManager->persist($hoja);
            $entityManager->flush();
            $entityManager->remove($acto);
            $entityManager->flush();
            $this->addFlash('success', '¡Registro eliminado correctamente!');
        }

        return $this->redirectToRoute('acto_index');
            
    }
}
