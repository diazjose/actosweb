<?php
namespace App\Controller;

use App\Entity\DocPersonal;
use App\Entity\Persona;
use App\Form\DocPersonalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DocPersonalController extends AbstractController
{
    /**
     * @Route("/documento/new", name="document_new", methods={"GET","POST"})
     */
    public function new(Request $request)
    {   
        $idPer = $request->get('id');
        $tipo = $request->get('tipo');
        $document = new DocPersonal();
        $document->setTipo($tipo);
        $form = $this->createForm(DocPersonalType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form['archivo']->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                //$safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                //$newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
                
                $entityManager = $this->getDoctrine()->getManager();
                $persona = $entityManager->getRepository(Persona::class)->find($idPer);
                if($tipo == "Dni"){
                    $newFilename = $persona->getDni().'.'.$brochureFile->guessExtension();
                    $this->addFlash('success', '¡Registro de DNI agregado correctamente!');
                }else{
                    $this->addFlash('success', '¡Registro CUIL agregado correctamente!');
                    $newFilename = $persona->getCuil().'.'.$brochureFile->guessExtension();
                }
                //$newFilename = uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('document_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $document->setFileName($newFilename);
            }

            // ... persist the $product variable or any other work            
            $date = new \DateTime();
            $document->setPersona($persona);
            $document->setCreatedAt($date);
            $document->setUpdatedAt($date);
            $entityManager->persist($document);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('persona_show', ['id' => $idPer]));
        }

        return $this->render('personas/documento.html.twig', [
            'form' => $form->createView(),
            'id' => $idPer,
        ]);
    }
}
