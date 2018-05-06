<?php

namespace BGKT\CoreBundle\Form;

use BGKT\CoreBundle\Enum\ClasseEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class CoursType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('document', FileType::class, array('label' => 'Cliquez sur ce boutton pour accéder au cours que vous voulez uploader : '))
            ->add('intitule')
            ->add('classe', ChoiceType::class, array(
                'required' => true,
                'choices' => ClasseEnum::getAvailableClasses(),
                'choice_label' => function ($choice) {
                    return ClasseEnum::getClasseName($choice);
                }
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BGKT\CoreBundle\Entity\Cours'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bgkt_corebundle_cours';
    }


}
