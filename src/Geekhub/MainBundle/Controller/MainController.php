<?php

namespace Geekhub\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{

    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($name)
    {
        $serviceResult = $this->get('my_simple_service')->returnServiceName();

        return $this->render('GeekhubMainBundle:Main:index.html.twig', ['name' => $name, 'serviceResult' => $serviceResult]);
    }
}
