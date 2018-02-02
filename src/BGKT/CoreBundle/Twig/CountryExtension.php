<?php
/**
 * Created by PhpStorm.
 * User: ytoque
 * Date: 25/01/2017
 * Time: 11:22
 */

namespace BGKT\CoreBundle\Twig;

use Symfony\Component\Intl\Intl;

class CountryExtension extends \Twig_Extension  {
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('countryName', array($this, 'countryName')),
        );
    }

    public function countryName($countryCode){
        return \Symfony\Component\Intl\Intl::getRegionBundle()->getCountryName($countryCode);
    }

    public function getName()
    {
        return 'country_extension';
    }

}


