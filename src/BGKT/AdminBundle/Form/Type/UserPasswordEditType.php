<?php
/**
 * Created by PhpStorm.
 * User: ytoque
 * Date: 10/01/2017
 * Time: 16:58
 */

namespace BGKT\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserPasswordEditType extends AbstractType
 {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('password', PasswordType::class,array(
            'label'=>'Entrez votre nouveau mot de passe :'));
    }



}




