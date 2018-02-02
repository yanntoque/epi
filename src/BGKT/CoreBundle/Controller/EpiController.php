<?php
namespace BGKT\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BGKT\CoreBundle\Entity\Document;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class EpiController extends Controller
{

    public function userCalendarShowAction(){
        return $this->render('BGKTCoreBundle:userPages:userCalenderPage.html.twig');
    }
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
     public function uploadDocumentViewAction(){
         $lstUploadedDocuments = $this->getDoctrine()->getManager()->getRepository('BGKTCoreBundle:Document')->findAll();
         return $this->render('BGKTCoreBundle:userPages:userUpload.html.twig', array('lstUploadedDocuments' => $lstUploadedDocuments));
     }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uploadDocumentTDViewAction(){
        $lstUploadedDocuments = $this->getDoctrine()->getManager()->getRepository('BGKTCoreBundle:Document')->findAll();
        return $this->render('BGKTCoreBundle:userPages:userUploadTD.html.twig', array('lstUploadedDocuments' => $lstUploadedDocuments));
    }

    /**
     * *
     * @Method({"GET", "POST"})
     * @Route("/ajax/snippet/image/send", name="ajax_snippet_image_send")
     * @param Request $request
     *
     */
    public function ajaxSnippetImageSendAction(Request $request)
    {
        $em = $this->container->get("doctrine.orm.default_entity_manager");

        $document = new Document();
        $media = $request->files->get('file');

        $document->setFile($media);
        $document->setPath($media->getPathName());
        $document->setName($media->getClientOriginalName());
        $document->upload();
        $em->persist($document);
        $em->flush();

        //infos sur le document envoyé
        //var_dump($request->files->get('file'));die;
        return $this->json(array('success' => true));
    }




}