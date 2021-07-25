<?php

namespace App\Controller;

use App\Entity\Caja;
use App\Entity\TipoCaja;
use App\Entity\TipoPago;
use App\Entity\Acto;
use App\Form\CajaType;
use App\Form\CajaFiltroType;
use App\Repository\CajaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/caja")
 */
class CajaController extends AbstractController
{
    /**
     * @Route("/", name="caja_index", methods={"GET","POST"})
     */
    public function index(Request $request, CajaRepository $cajaRepository): Response
    {
        $caja = new Caja();
        $form = $this->createForm(CajaType::class, $caja);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $date = new \DateTime();
            $caja->setFecha($date);
            $caja->setCreatedAt($date);
            $caja->setUpdatedAt($date);
            $entityManager->persist($caja);
            $entityManager->flush();
            $this->addFlash('success', '!Movimiento agregado correctamente!');
            
            return $this->redirectToRoute('caja_index');
            
        }
        $em = $this->getDoctrine()->getManager();
        //$movimientos = $em->getRepository(Caja::class)->findBy(array(), array('monto' => 'DESC')); 
        //$movimientos = $cajaRepository->todos(); 
        $movimientos = $cajaRepository->cajaDia();
        $conceptos = $em->getRepository(TipoCaja::class)->findAll();

        return $this->render('caja/index.html.twig', [
            'movimientos' => $movimientos,
            'conceptos' => $conceptos,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new_pago", name="caja_pago", methods={"GET","POST"})
     */
    public function new_pago(Request $request): Response
    {
        //if ($this->isCsrfTokenValid($request->request->get('_token'))) {
            $idActo = $request->request->get('id');
            $caja = new Caja();
            
            $entityManager = $this->getDoctrine()->getManager();
            $acto = $entityManager->getRepository(Acto::class)->find($idActo);
            $tipoCaja = $entityManager->getRepository(TipoCaja::class)->find($request->request->get('concepto'));
            $tipoPago = $entityManager->getRepository(TipoPago::class)->find($request->request->get('tipoPago'));
            
            $caja->setConcepto($tipoCaja);
            $caja->setTipoPago($tipoPago);
            $caja->setActo($acto);
            $caja->setMonto($request->request->get('monto'));
            $con = count($acto->getPagos()) + 1;
            $caja->setDetalle('Pago de cuota N°'.$con);

            $date = new \DateTime();
            $caja->setFecha($date);
            $caja->setCreatedAt($date);
            $caja->setUpdatedAt($date);
            $entityManager->persist($caja);
            $entityManager->flush();
            $this->addFlash('success', '!Pago realizado correctamente!');
                
            return $this->redirectToRoute('acto_show', ['id' => $idActo]);
            
        //}
        
    }

    /**
     * @Route("/edit_pago/{id}", name="caja_pago_edit", methods={"GET","POST"})
     */
    public function edit_pago(Request $request, Caja $caja): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $caja->setMonto($request->request->get('monto'));
        $tipoTipo = $entityManager->getRepository(TipoTipo::class)->find($request->request->get('tipoPago'));
        $caja->setTipoPago($tipoPago);    
        $date = new \DateTime();
        $caja->setFecha($date);
        $caja->setUpdatedAt($date);
        $entityManager->persist($caja);
        $entityManager->flush();
        $this->addFlash('success', '!Pago actualizado correctamente!');
             
        return $this->redirectToRoute('acto_show', ['id' => $caja->getActo()->getId()]);
    }

    /**
     * @Route("/edit/{id}", name="caja_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Caja $caja): Response
    {
        if ($this->isCsrfTokenValid('edit'.$caja->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $concepto = $entityManager->getRepository(TipoCaja::class)->find($request->request->get('concepto'));
            $caja->setMonto($request->request->get('monto'));
            $caja->setDetalle($request->request->get('detalle'));
            $caja->setConcepto($concepto);
            $date = new \DateTime();
            $caja->setUpdatedAt($date);
            $entityManager->persist($caja);
            $entityManager->flush();

            $this->addFlash('success', '¡Movimiento Actualizado correctamente!');
        }
        return $this->redirectToRoute('caja_index');
    }

    /**
     * @Route("/{id}", name="caja_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Caja $caja): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caja->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($caja);
            $entityManager->flush();
            $this->addFlash('success', '¡Movimiento eliminado correctamente!');
        }

        return $this->redirectToRoute('caja_index');
    }

    /**
     * @Route("/consultas", name="caja_consultas", methods={"GET","POST"})
     */
    public function consulta(Request $request, CajaRepository $cajaRepository): Response
    {
        $consulta = [];
        $inicio = '';
        $fin = '';
        $concepto = '';
        $tipo = '';
        if($request->request->get('fechaIni') or $request->request->get('fechaIni') or $request->request->get('concepto') or $request->request->get('tipoPago')){
            $consulta['fechaIni'] = $request->request->get('fechaIni');
            $consulta['fechaFin'] = $request->request->get('fechaFin');
            $consulta['concepto'] = $request->request->get('concepto');
            $consulta['tipoPago'] = $request->request->get('tipoPago');
        }
        if($request->request->get('fechaIni')){
            $inicio = $request->request->get('fechaIni');
        }
        if($request->request->get('fechaFin')){
            $fin = $request->request->get('fechaFin');
        }        
        if($request->request->get('concepto') != ''){
            $entityManager = $this->getDoctrine()->getManager();
            $concepto = $entityManager->getRepository(TipoCaja::class)->find($request->request->get('concepto'));
        }
        if($request->request->get('tipoPago') != ''){
            $entityManager = $this->getDoctrine()->getManager();
            $tipo = $entityManager->getRepository(TipoPago::class)->find($request->request->get('tipoPago'));
        }

        $movimientos = $cajaRepository->findForActionIndex($consulta);
        
        $em = $this->getDoctrine()->getManager();
        $conceptos = $em->getRepository(TipoCaja::class)->findAll();
        $tipos = $em->getRepository(TipoPago::class)->findAll();

        return $this->render('caja/consultas.html.twig', [
            'movimientos' => $movimientos,
            'conceptos' => $conceptos,
            'tipos' => $tipos,
            'inicio' => $inicio,
            'fin' => $fin,
            'concepto' => $concepto,
            'tipo' => $tipo,
        ]);
    }

}
