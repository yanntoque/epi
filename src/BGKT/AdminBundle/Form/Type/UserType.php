<?php

namespace BGKT\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class,
                  array('label' => 'Pseudonyme de l\'utilisateur : '))
                ->add('nom', TextType::class,
                  array('label' => 'Nom : '))
                ->add('prenom', TextType::class,
                    array('label' => 'Prénom : '))
                ->add('password', PasswordType::class,
                  array('label' => 'Mot de passe : '))
                ->add('email', EmailType::class,
                  array('label' => 'Email :'))
                ->add('roles', ChoiceType::class,
                  array('multiple' => true,
                        'expanded' => true,
                        'choices'  => array('utilisateur' => 'ROLE_ADMIN',
                                            'Professeur' => 'ROLE_TEACHER',
                                            'Étudiant ou Apprenti' => 'ROLE_STUDENT'
                                             ),))
                ->add('save', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BGKT\AdminBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'BGKT_adminbundle_user';
    }


}
