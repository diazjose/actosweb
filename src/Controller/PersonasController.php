<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Form\PersonaType;
use App\Repository\PersonaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/persona")
 */
class PersonasController extends AbstractController
{
    /**
     * @Route("/", name="persona_index", methods={"GET"})
     */
    public function index(Request $request, PersonaRepository $personaRepository, PaginatorInterface $paginator): Response
    {

        $em = $this->getDoctrine()->getManager();
        $personas = $em->getRepository(Persona::class)->findAll();        

        return $this->render('personas/index.html.twig', [
            'personas' => $personas,
        ]);
    }

    /**
     * @Route("/new", name="persona_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $persona = new Persona();
        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $date = new \DateTime();
            $persona->setCreatedAt($date);
            $persona->setUpdatedAt($date);
            $entityManager->persist($persona);
            $entityManager->flush();

            $this->addFlash('success', '¡Registro agregado correctamente!');
            return $this->redirectToRoute('persona_index');
        }

        return $this->render('personas/new.html.twig', [
            'persona' => $persona,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="persona_show", methods={"GET"})
     */
    public function show(Persona $persona): Response
    {
        return $this->render('personas/show.html.twig', [
            'persona' => $persona,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="persona_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Persona $persona): Response
    {
        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', '¡Registro actualizado correctamente!');

            return $this->redirectToRoute('persona_index', [
                'id' => $persona->getId(),
            ]);
        }

        return $this->render('personas/edit.html.twig', [
            'persona' => $persona,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="persona_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Persona $persona): Response
    {
        if ($this->isCsrfTokenValid('delete'.$persona->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($persona);
            $entityManager->flush();
            $this->addFlash('success', '¡Registro eliminado correctamente!');
        }

        return $this->redirectToRoute('persona_index');
    }
}
