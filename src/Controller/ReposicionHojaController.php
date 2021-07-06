<?php

namespace App\Controller;

use App\Entity\Hoja;
use App\Entity\ReposicionHoja;
use App\Form\ReposicionHojaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ReposicionHojas")
 */
class ReposicionHojaController extends AbstractController
{
    
    /**
     * @Route("/new", name="reposicionHoja_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $idHoja = $request->get('id');
        $ReposicionHoja = new ReposicionHoja();
        $form = $this->createForm(ReposicionHojaType::class, $ReposicionHoja);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $hoja = $entityManager->getRepository(Hoja::class)->find($idHoja);
            
            $date = new \DateTime();
            $ReposicionHoja->setHoja($hoja);
            $ReposicionHoja->setCreatedAt($date);
            $ReposicionHoja->setUpdatedAt($date);
            $entityManager->persist($ReposicionHoja);

            $cantidad = $hoja->getCantidad() + $ReposicionHoja->getCantidad();
            $hoja->setCantidad($cantidad);          
            $entityManager->persist($hoja);
            $entityManager->flush();

            $this->addFlash('success', '¡Registro agregado correctamente!');
            return $this->redirectToRoute('hoja_show',['id' => $idHoja]);
            
        }
        
        return $this->render('reposicion_hoja/new.html.twig', [
            'reposicionHoja' => $ReposicionHoja,
            'form' => $form->createView(),
            'id' => $idHoja,
        ]);
    }

     /**
     * @Route("/edit/{id}", name="reposicionHoja_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ReposicionHoja $ReposicionHoja): Response
    {
        $form = $this->createForm(ReposicionHojaType::class, $ReposicionHoja);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $hoja = $entityManager->getRepository(Hoja::class)->find($ReposicionHoja->getHoja()->getId());
            $cant = $request->request->get('cant');
            
            $cantidad = $hoja->getCantidad() - $cant;
            $cantidad = $cantidad + $ReposicionHoja->getCantidad();
            $hoja->setCantidad($cantidad);          
            $entityManager->persist($hoja);

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', '¡Registro actualizado correctamente!');

            return $this->redirectToRoute('hoja_show', [
                'id' => $ReposicionHoja->getHoja()->getId(),
            ]);
        }

        return $this->render('reposicion_hoja/edit.html.twig', [
            'reposicionHoja' => $ReposicionHoja,
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/{id}", name="reposicionHoja_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ReposicionHoja $ReposicionHoja): Response
    {
        $id = $ReposicionHoja->getHoja()->getId();
        if ($this->isCsrfTokenValid('delete'.$ReposicionHoja->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $hoja = $entityManager->getRepository(Hoja::class)->find($ReposicionHoja->getHoja()->getId());

            $cant = $request->request->get('cant');
            $cantidad = $hoja->getCantidad() - $cant;
            $hoja->setCantidad($cantidad);          
            $entityManager->persist($hoja);
            $entityManager->remove($ReposicionHoja);
            
            $entityManager->flush();
            $this->addFlash('success', '¡Registro eliminado correctamente!');
        }

        return $this->redirectToRoute('hoja_show',['id' => $id]);
    }
}
