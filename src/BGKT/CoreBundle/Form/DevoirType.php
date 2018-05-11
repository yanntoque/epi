<?php

namespace BGKT\CoreBundle\Form;

use BGKT\AdminBundle\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevoirType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')
            ->add('commentaire')
            ->add('professeur', EntityType::class, array('class' => 'BGKTAdminBundle:User', 'choice_label' => function ($professeur) {
                return $professeur->getNom() . " " . $professeur->getPrenom();
            }, 'query_builder' => function (UserRepository $repo) {
                return $repo->findByRoles('teacher');
            }))
            ->add('document');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BGKT\CoreBundle\Entity\Devoir'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bgkt_corebundle_devoir';
    }


}
