<?php

namespace Geekhub\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{

    /**
     * Main page where you can see last posts and comments
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $lastPosts = $this->getDoctrine()->getRepository('GeekhubMainBundle:Post')->findLatest(5);
        $lastComments = $this->getDoctrine()->getRepository('GeekhubMainBundle:Comment')->findLatest(5);

        return $this->render('GeekhubMainBundle:Main:index.html.twig', ['posts' => $lastPosts, 'comments' => $lastComments]);
    }

    /**
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function firstAction($name)
    {
        $twigArray = [
            'key' => 'value',
            'test' => 'val',
            'geek' => 'team',
        ];
        $serviceResult = $this->get('my_simple_service')->returnServiceName($name);
        $time = time();

        return $this->render('GeekhubMainBundle:Main:first.html.twig', [
            'name' => $name,
            'serviceResult' => $serviceResult,
            'twigArray' => $twigArray,
            'time' => $time,
        ]);
    }

    /**
     * Render template where testing some twig features
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testTwigAction()
    {
        $comments = $this->getDoctrine()->getRepository('GeekhubMainBundle:Comment')->findAll();

        return $this->render('GeekhubMainBundle:Main:testTwig.html.twig', ['comments' => $comments]);
    }

    /**
     * Show data from table with ManyToMany Self-Referencing relation
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function manyToManyAction()
    {
        $details = $this->getDoctrine()->getRepository('GeekhubMainBundle:Detail')->findAll();

        return $this->render('GeekhubMainBundle:Main:many_to_many.html.twig', ['details' => $details]);
    }
}
