<?php
namespace BGKT\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BGKT\CoreBundle\Entity\Document;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class EpiController extends Controller
{
    public function userCalendarShowAction(){
        return $this->render('BGKTCoreBundle:userPages:userCalenderPage.html.twig');
    }
}