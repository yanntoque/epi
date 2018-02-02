<?php
/**
 * Created by PhpStorm.
 * User: ytoque
 * Date: 26/01/2017
 * Time: 15:27
 */

namespace BGKT\CoreBundle\Twig;


class RawFilterExtension extends \Twig_Extension {

    public function getFilters(){
        return array(new \Twig_SimpleFilter('html', array($this, 'html'), array('is_safe' => array('html'))),);
    }

    public function html($message)
    {
        return $message;
    }

    public function getName()
    {
          return 'rawFilter_extension';
    }


 }



