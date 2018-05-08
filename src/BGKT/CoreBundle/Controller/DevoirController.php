<?php

namespace BGKT\CoreBundle\Controller;

use BGKT\CoreBundle\Entity\Devoir;
use BGKT\CoreBundle\Form\DevoirType;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Request;

class DevoirController extends Controller
{
    /**
     * @Route("/devoir/ajouter", name="user_ajouter_devoir")
     */
    public function newAction(Request $request)
    {
        $devoir = new Devoir();
        $form = $this->createForm(DevoirType::class, $devoir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->get('security.token_storage')->getToken()->getUser()->getUserName();
            $userClasse = $this->get('security.token_storage')->getToken()->getUser()->getClasse();

            $devoir->setNomDepositaire($user);
            $devoir->setDateRendu(new \DateTime());
            $devoir->setClasse($userClasse);
            $devoir = $this->get('core.file_uploader')->upload($devoir);


            $em = $this->getDoctrine()->getManager();
            $em->persist($devoir);
            $em->flush();

            return $this->redirect($this->generateUrl('user_liste_devoir'));
        }

        return $this->render('BGKTCoreBundle:Devoir:ajouterDevoir.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function displayAction(){
        $lstDevoir = $this->getDoctrine()->getManager()->getRepository('BGKTCoreBundle:Devoir')->findAll();
        return $this->render('BGKTCoreBundle:Devoir:listeDevoir.html.twig', array('lstdevoir' => $lstDevoir));
    }

}
