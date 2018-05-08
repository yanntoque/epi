<?php
/**
 * Created by PhpStorm.
 * User: toque
 * Date: 08/05/2018
 * Time: 15:36
 */

namespace BGKT\CoreBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class DevoirEditType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        # Same as parent form
    }

    public function getParent()
    {
        return DevoirType::class;
    }
}



