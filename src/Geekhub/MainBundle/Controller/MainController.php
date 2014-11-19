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
        $twigArray = [
            'key'  => 'value',
            'test' => 'val',
            'geek' => 'team',
        ];
        $serviceResult = $this->get('my_simple_service')->returnServiceName();
        $time = time();

        return $this->render('GeekhubMainBundle:Main:index.html.twig', [
            'name' => $name,
            'serviceResult' => $serviceResult,
            'twigArray' => $twigArray,
            'time' => $time,
        ]);
    }
}
