<?php

namespace App\Controller;

use App\Entity\TipoRol;
use App\Entity\Persona;
use App\Entity\Acto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("acto/tipo/rol")
 */
class TipoRolController extends AbstractController
{
    /**
     * @Route("/{id}/personas", name="personas_list", methods={"GET"})
     */
    public function list_personas(Request $request, Acto $acto): Response
    {
        $rol = $request->get('rol');

        $em = $this->getDoctrine()->getManager();
        $personas = $em->getRepository(Persona::class)->findAll(); 

        return $this->render('actos/newRol.html.twig', [
            'personas' => $personas,
            'rol' => $rol,
            'idActo' => $acto->getId(),
        ]);                
    }
    
    /**
     * @Route("/new_rol", name="new_rol", methods={"GET","POST"})
     */
    public function new_rol(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $acto = $em->getRepository(Acto::class)->find($request->get('idActo'));
        $persona = $em->getRepository(Persona::class)->find($request->get('id'));
        
        $tipoRol = new TipoRol();
        $tipoRol->setNombre($request->get('rol'));
        $tipoRol->setPersona($persona);
        $tipoRol->setActo($acto);
        $date = new \DateTime();
        $tipoRol->setCreatedAt($date);
        $tipoRol->setUpdatedAt($date);
        $em->persist($tipoRol);
        $em->flush();

        $this->addFlash('success', '¡Se agrego '.$request->get('rol').' correctamente!');

        return $this->redirectToRoute('acto_show', ['id' => $request->get('idActo')]);    
    }

    /**
     * @Route("/acto_delete_rol/{id}", name="acto_delete_rol", methods={"DELETE"})
     */
    public function acto_delete_rol(Request $request, TipoRol $tipoRol): Response
    {   
        $id = $tipoRol->getActo()->getId();
        $rol = $tipoRol->getNombre();
        if ($this->isCsrfTokenValid('delete'.$tipoRol->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tipoRol);
            $entityManager->flush();
            $this->addFlash('success', '¡'.$rol.' eliminado correctamente!');
        }

        return $this->redirectToRoute('acto_show', ['id' => $id]);
            
    }
}
