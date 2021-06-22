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
        $viene = $request->get('viene');
        $idPer = $request->get('idPer');

        $em = $this->getDoctrine()->getManager();
        $personas = $em->getRepository(Persona::class)->findAll();        

        if($viene){
            $per = $em->getRepository(Persona::class)->find($idPer);
            return $this->render('personas/parent.html.twig', [
                'personas' => $personas,
                'pers' => $per
            ]);
        }else{
            return $this->render('personas/index.html.twig', [
                'personas' => $personas,
            ]);
        }        
    }

    /**
     * @Route("/new", name="persona_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $idPer = $request->get('id');
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

            if($idPer){
                $this->addFlash('success', '¡Registro agregado correctamente!');
                return $this->redirectToRoute('persona_index', ['viene' => 'persona','idPer' => $idPer]);
            }else{
                $this->addFlash('success', '¡Registro agregado correctamente!');
                return $this->redirectToRoute('persona_index');
            }
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

    /**
     * @Route("/new_Conyuge", name="new_Conyuge", methods={"GET","POST"})
     */
    public function new_Conyuge(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $persona = $em->getRepository(Persona::class)->find($request->get('idPer'));
        $parent = $em->getRepository(Persona::class)->find($request->get('id'));

        $persona->setParent($parent);
        $em->persist($persona);
        $em->flush();

        $parent->setParent($persona);
        $em->persist($parent);
        $em->flush();

        $this->addFlash('success', '¡Se ha Registro Cónyuge correctamente!');

        return $this->redirectToRoute('persona_show', ['id' => $request->get('idPer')]);    
    }

    /**
     * @Route("/delete_Conyuge", name="delete_Conyuge", methods={"GET","POST"})
     */
    public function delete_Conyuge(Request $request): Response
    {   
        $em = $this->getDoctrine()->getManager();
        $persona = $em->getRepository(Persona::class)->find($request->get('id'));
        $parent = $em->getRepository(Persona::class)->find($persona->getParent()->getId());

        $parent->setParent(NULL);
        $em->persist($parent);
        $em->flush();

        $persona->setParent(NULL);
        $em->persist($persona);
        $em->flush();

        $this->addFlash('success', '¡Se ha Eliminado Cónyuge correctamente!');

        return $this->redirectToRoute('persona_show', ['id' => $request->get('id')]);    
    }
}
