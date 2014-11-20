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
            'key' => 'value',
            'test' => 'val',
            'geek' => 'team',
        ];
        $serviceResult = $this->get('my_simple_service')->returnServiceName();

        return $this->render('GeekhubMainBundle:Main:index.html.twig', ['name' => $name, 'serviceResult' => $serviceResult, 'twigArray' => $twigArray]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPostsAction()
    {
        $posts = $this->getDoctrine()->getRepository('GeekhubMainBundle:Post')->findAll();

        return $this->render('GeekhubMainBundle:Main:showPosts.html.twig', ['posts' => $posts]);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPostAction($id)
    {
        $post = $this->getDoctrine()->getRepository('GeekhubMainBundle:Post')->find($id);

        return $this->render('GeekhubMainBundle:Main:showPost.html.twig', ['post' => $post]);
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testTwigAction()
    {
        return $this->render('GeekhubMainBundle:Main:testTwig.html.twig');
    }
}
