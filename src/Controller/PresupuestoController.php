<?php

namespace App\Controller;

use App\Entity\Presupuesto;
use App\Entity\TipoActo;
use App\Entity\Detalle;
use App\Entity\DetallePresupuesto;
use App\Form\PresupuestoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;


/**
 * @Route("/presupuesto")
 */
class PresupuestoController extends AbstractController
{
    /**
     * @Route("/", name="presupuesto_index", methods={"POST","GET"})
     */
    public function index(Request $request): Response
    {   
        $presupuesto = new Presupuesto();
        $form = $this->createForm(PresupuestoType::class, $presupuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $date = new \DateTime();
            $presupuesto->setFecha($date);
            $presupuesto->setCreatedAt($date);
            $presupuesto->setUpdatedAt($date);
            $entityManager->persist($presupuesto);
            $entityManager->flush();
            $this->addFlash('success', '!Presupuesto agregado correctamente!');
            return $this->redirectToRoute('presupuesto_index');
            
        }
        $em = $this->getDoctrine()->getManager();
        $actos = $em->getRepository(TipoActo::class)->findAll();
        //$presupuestos = $em->getRepository(DetallePresupuesto::class)->findAll();
        $presupuestos = $em->getRepository(Presupuesto::class)->findAll();       
        
        return $this->render('presupuesto/index.html.twig', [
                'presupuestos' => $presupuestos,
                'form' => $form->createView(),
            ]);       
    }

    /**
     * @Route("/{id}", name="presupuesto_show", methods={"GET"})
     */
    public function show(Presupuesto $presupuesto): Response
    {
        $em = $this->getDoctrine()->getManager();
        $detalles = $em->getRepository(DetallePresupuesto::class)->findAll();
        return $this->render('presupuesto/show.html.twig', [
            'presupuesto' => $presupuesto,
            'detalles' => $detalles,
        ]);
    }

    /**
     * @Route("/presupuestoDetalle", name="presupuestoDetalle_new", methods={"POST"})
     */
    public function delete(Request $request): Response
    {   
        if ($this->isCsrfTokenValid('new'.$request->request->get('id'), $request->request->get('_token'))) {
            $dePre = new Detalle();
            $en = $this->getDoctrine()->getManager();
            $detalle = $en->getRepository(DetallePresupuesto::class)->find($request->request->get('detalle'));
            $pre = $en->getRepository(Presupuesto::class)->find($request->request->get('id'));
            $dePre->setPresupuesto($pre);
            $dePre->setDetallePresupuesto($detalle);
            $date = new \DateTime();
            $dePre->setCreatedAt($date);
            $dePre->setUpdatedAt($date);
            $en->persist($dePre);
            $en->flush();
            
            $this->addFlash('success', '¡Detalle agregado correctamente!');
        }

        return $this->redirectToRoute('presupuesto_show', ['id' => $request->request->get('id') ]);
            
    }

    /**
     * @Route("/presupuestoDetalle/{id}", name="presupuestoDetalle_delete", methods={"DELETE"})
     */
    public function acto_delete_rol(Request $request, Detalle $detalle): Response
    {   
        $id = $detalle->getPresupuesto()->getId();

        if ($this->isCsrfTokenValid('delete'.$detalle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($detalle);
            $entityManager->flush();
            $this->addFlash('success', '¡Detalle eliminado correctamente!');
        }

        return $this->redirectToRoute('presupuesto_show', ['id' => $id]);
            
    }

    /**
     * @Route("/presupuestoImprimir/{id}", name="presupuesto_imprimir", methods={"POST","GET"})
     */
    public function imprimir(Request $request, Presupuesto $presupuesto): Response
    {   
       // $id = $presupuesto->getId();
        
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);       

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('presupuesto/_imprimir_presupuesto.html.twig', [
            'pre' => $presupuesto,
            'precio' => $request->request->get('precio'),
            'requirente' => $request->request->get('requirente'),
            'indivInmueble' => $request->request->get('indivInmueble'),
        ]);      
        $html .= '<link type="text/css" href="../assets/templates/templates.css" rel="stylesheet" />';
        $nombrepdf="Certificado_Antecedente_";   

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        //$dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
            
        $dompdf->stream($nombrepdf.".pdf", [
            "Attachment" => false
        ]);
        /*
        return $this->render('presupuesto/_imprimir_presupuesto.html.twig', [
                'pre' => $presupuesto,
                'precio' => $request->request->get('precio'),
                'requirente' => $request->request->get('requirente'),
                'indivInmueble' => $request->request->get('indivInmueble'),
            ]);      */              
    }
}
