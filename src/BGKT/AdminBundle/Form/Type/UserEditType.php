<?php
/**
 * Created by PhpStorm.
 * User: ytoque
 * Date: 10/01/2017
 * Time: 11:35
 */

namespace BGKT\AdminBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class UserEditType extends AbstractType
 {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->remove('password')
                ->remove('roles');
    }


    public function getParent()
    {
        return UserType::class;
    }

}







