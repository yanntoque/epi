<?php
/**
 * Created by PhpStorm.
 * User: ytoque
 * Date: 06/01/2017
 * Time: 10:25
 */

namespace BGKT\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BGKT\AdminBundle\Entity\User;
use BGKT\AdminBundle\Form\Type\UserEditType;
use BGKT\AdminBundle\Form\Type\UserType;
use BGKT\AdminBundle\Form\Type\UserPasswordEditType;


class AuthController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexUserAction()
    {
        return $this->render("BGKTCoreBundle:userPages:userHomePage.html.twig");
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAdminAction(){
        $em = $this->getDoctrine()->getManager();
        $lstUsers = $em->getRepository('BGKTAdminBundle:User')->findAll();
        return $this->render("BGKTAdminBundle:User:index.html.twig", array('users' => $lstUsers));
    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
    {
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED') && $this->get('security.authorization_checker')->isGranted('ROLE_TEACHER') || $this->get('security.authorization_checker')->isGranted('ROLE_STUDENT')) {
            return $this->redirectToRoute('user_homepage');
        } else if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED') && $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('admin_homepage');
        }

        // Le service authentication_utils permet de récupérer le nom d'utilisateur
        // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
        // (mauvais mot de passe par exemple)
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('BGKTAdminBundle:Auth:login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ));
    }


    public function updatePasswordAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('BGKTAdminBundle:User')->find($id);

        $form = $this->createForm(UserPasswordEditType::class);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $edit = $request->request->get('user_password_edit');

            /*   // Mail avec mot de passe mis à jour
               $message = \Swift_Message::newInstance()
                   ->setSubject('Mise à jour de votre mot de passe - EPI')
                   ->setFrom('fake@domain.com')
                   ->setTo($user->getEmail())
                   ->setBody(
                       $this->renderView
                       (
                           'BGKTAdminBundle:Email:mailUpdatePassword.html.twig',
                           array(
                               'password' => $edit['password']
                           )
                       ),
                       'text/html'
                   );
               $this->get('mailer')->send($message);
   */

            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $edit['password']);
            $user->setPassword($encoded);
            $em->flush();
            return $this->redirectToRoute('admin_homepage', array());
        }
        return $this->render('BGKTAdminBundle:User:updatePassword.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *Cette fonction permet de mettre à jour les données de l'utilisateur
     */
    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('BGKTAdminBundle:User')->find($id);

        $form = $this->createForm(UserEditType::class, $user);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            return $this->redirectToRoute('admin_homepage', array());
        }
        return $this->render('BGKTAdminBundle:User:update.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * Cette fonction permet de supprimer un utilisateur
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BGKTAdminBundle:User')->find($id);

        $form = $this->get('form.factory')->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($user);
            $em->flush();

            return $this->redirectToRoute('admin_homepage');
        }

        return $this->render('BGKTAdminBundle:User:delete.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *Cette fonction permet de créer un nouvel utilisateur et de lui envoyer un mail avec ses identifiants
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $form = $this->createForm(UserType::class, $user);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            /*           // Mail avec les identifiants
                       $message = \Swift_Message::newInstance()
                           ->setSubject('Code d\'accès - EPI')
                           ->setFrom('fake@domain.com')
                           ->setTo($user->getEmail())
                           ->setBody(
                            $this->renderView
                            (
                                'BGKTAdminBundle:Email:identifiants.html.twig',
                                    array(
                                        'username' => $user->getUsername(),
                                        'password' => $user->getPassword()
                                        )
                            ),
                                      'text/html'
                                );
                           $this->get('mailer')->send($message);
    */

            // Hashage du mot de passe avec la nouvelle référence Bcrypt, depuis php 5.5
            $encoder = $this->container->get('security.password_encoder');

            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $user->setCle($user->generateCle(25));

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('admin_homepage', array());

        }
        return $this->render('BGKTAdminBundle:User:create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     */
    public function forgotPasswordAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $email = $request->request->get('_email');
        if (isset($email)) {
            $user = $em->getRepository('BGKTAdminBundle:User')->findOneBy(array('email' => $email));
            if ($user) {
                $generate = $user->generateCle(25);
                $user->setCle($generate);
                $user->setDateModif(new \DateTime());
                $em->flush();
                $message = \Swift_Message::newInstance()
                    ->setSubject('Mot de passe oublié - EPI ')
                    ->setFrom('fake@domain.com')
                    ->setTo($user->getEmail())
                    ->setBody(
                        $this->renderView(
                            '@BGKTAdmin/Email/mailForgotPassword.html.twig',
                            array(
                                'cle' => $user->getCle(),
                                'email' => $user->getEmail()
                            )
                        ),
                        'text/html'
                    );
                $this->get('mailer')->send($message);
                $this->addFlash(
                    'success',
                    'Nous venons de vous envoyer un mail contenant un lien pour modifier votre mot de passe');
                return $this->redirectToRoute('login', array());
            } else {
                $this->addFlash(
                    'warning',
                    'Cette adresse email n\'existe pas.');
            }
        }

        return $this->render('BGKTAdminBundle:Auth:forgotPassword.html.twig', array());
    }

    /**
     * @param Request $request
     * @param $cle
     * @param $email
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     */
    public function checkForgotPasswordAction(Request $request, $cle, $email)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('BGKTAdminBundle:User')
            ->findOneBy(
                array(
                    'cle' => $cle,
                    'email' => $email
                ));

        if ($user) {
            $d1 = $user->getDateModif();
            $d2 = new \DateTime();
            $diff = $d1->diff($d2);
            if ($diff->format('%I') <= 10) {
                $form = $this->createForm(UserPasswordEditType::class);
                if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
                    $edit = $request->request->get('user_password_edit');

                    // Mail contenant le mot de passe réinitialisé
                    $message = \Swift_Message::newInstance()
                        ->setSubject('Réinitialisation de votre mot de passe- EPI')
                        ->setFrom('fake@domain.com')
                        ->setTo($user->getEmail())
                        ->setBody(
                            $this->renderView
                            (
                                'BGKTAdminBundle:Email:mailPasswordReboot.html.twig',
                                array(
                                    'password' => $edit['password']
                                )
                            ),
                            'text/html'
                        );
                    $this->get('mailer')->send($message);

                    $encoder = $this->container->get('security.password_encoder');
                    $encoded = $encoder->encodePassword($user, $edit['password']);
                    $user->setPassword($encoded);
                    $em->flush();
                    $this->addFlash(
                        'success',
                        'Votre mot de passe a été modifié. Un mail vous a été enovoyé avec votre nouveau mot de passe.'
                    );
                    return $this->redirectToRoute('login', array());
                }
                return $this->render('BGKTAdminBundle:Auth:forgotPasswordUpdate.html.twig', array(
                    'form' => $form->createView(),
                ));
            } else {
                $this->addFlash(
                    'warning',
                    'Vous avez dépassé le temps imparti pour modifier votre mot de passe.'
                );
                return $this->redirectToRoute('login', array());
            }
        } else {
            $this->addFlash(
                'warning',
                'Votre mot de passe n\'a pas été modifié'
            );
            return $this->redirectToRoute('login', array());
        }
    }
}




