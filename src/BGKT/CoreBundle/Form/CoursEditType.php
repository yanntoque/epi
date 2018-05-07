<?php
/**
 * Created by PhpStorm.
 * User: toque
 * Date: 07/05/2018
 * Time: 23:03
 */

namespace BGKT\CoreBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class CoursEditType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        # Same as parent form
    }

    public function getParent()
    {
        return CoursType::class;
    }
}