<?php

namespace BGKT\CoreBundle\Controller;

use BGKT\CoreBundle\Entity\Devoir;
use BGKT\CoreBundle\Form\DevoirType;
use BGKT\CoreBundle\Form\DevoirEditType;
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

            $user = $this->get('security.token_storage')->getToken()->getUser()->getPrenom() ." ".$this->get('security.token_storage')->getToken()->getUser()->getNom();
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

    public function editAction(Request $request, Devoir $devoir)
    {
        $old = $devoir->getDocument();
        $devoir->setDocument(
            new File($this->getParameter('devoir_directory') . '/' . $devoir->getDocument())
        );
        $new = $devoir->getDocument();


        $form = $this->createForm(DevoirEditType::class, $devoir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($old != $new) {
                unlink($new);
            }
            $devoir = $this->get('core.file_uploader')->upload($devoir);


            $em = $this->getDoctrine()->getManager();
            $em->persist($devoir);
            $em->flush();


            return $this->redirect($this->generateUrl('user_liste_devoir'));
        }

        return $this->render('BGKTCoreBundle:Devoir:modifierDevoir.html.twig', array(
            'devoir' => $devoir,
            'form' => $form->createView()
        ));
    }

    /**
     * @param Devoir $devoir
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Devoir $devoir)
    {
        if (!$devoir) {
            throw $this->createNotFoundException('Devoir non trouvé.');
        }

        $filename = $devoir->getDocument();
        $fs = new Filesystem();
        $fs->remove($this->get('kernel')->getRootDir() . '/../web/uploads/devoir/' . $filename);
        $em = $this->getDoctrine()->getManager();
        $em->remove($devoir);
        $em->flush();

        return $this->redirect($this->generateUrl('user_liste_devoir'));
    }

    public function displayAction()
    {
        $nomDepositaire = $this->get('security.token_storage')->getToken()->getUser()->getPrenom() ." ".$this->get('security.token_storage')->getToken()->getUser()->getNom();
        $lstDevoirEleve = $this->getDoctrine()->getManager()->getRepository('BGKTCoreBundle:Devoir')->findAllByDepositaire($nomDepositaire);
        $lstDevoirProf = $this->getDoctrine()->getManager()->getRepository('BGKTCoreBundle:Devoir')->findAll();

        return $this->render('BGKTCoreBundle:Devoir:listeDevoir.html.twig', array('lstdevoirEleve' => $lstDevoirEleve,'lstdevoirprof' => $lstDevoirProf));
    }

}
