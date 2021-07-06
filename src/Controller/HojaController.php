<?php

namespace App\Controller;

use App\Entity\Hoja;
use App\Entity\TipoActo;
use App\Form\HojaType;
use App\Repository\HojaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/hojas")
 */
class HojaController extends AbstractController
{
    /**
     * @Route("/", name="hoja_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $hojas = $em->getRepository(Hoja::class)->findAll();        
        $tipo = $em->getRepository(TipoActo::class)->findAll();     

        $cant_hojas = count($hojas);
        $cant_tipos = count($tipo);
        if($cant_hojas == $cant_tipos){
            $new = 'si';
        }else{
            $new = 'no';
        }

        return $this->render('hoja/index.html.twig', [
                'hojas' => $hojas,
                'new' => $new,
            ]); 
    }

    /**
     * @Route("/new", name="hoja_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hoja = new Hoja();
        $form = $this->createForm(HojaType::class, $hoja);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hoja);
            $entityManager->flush();

            $this->addFlash('success', '¡Registro agregado correctamente!');
            return $this->redirectToRoute('hoja_index');
            
        }
        
        return $this->render('hoja/new.html.twig', [
            'hoja' => $hoja,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hoja_show", methods={"GET"})
     */
    public function show(Hoja $hoja): Response
    {
        return $this->render('hoja/show.html.twig', [
            'hoja' => $hoja,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="hoja_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hoja $hoja): Response
    {
        $form = $this->createForm(HojaType::class, $hoja);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', '¡Registro actualizado correctamente!');

            return $this->redirectToRoute('hoja_show', [
                'id' => $hoja->getId(),
            ]);
        }

        return $this->render('hoja/edit.html.twig', [
            'hoja' => $hoja,
            'form' => $form->createView(),
        ]);
    }
}
