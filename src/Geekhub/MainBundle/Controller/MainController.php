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
     * Show all posts of application
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPostsAction()
    {
        $posts = $this->getDoctrine()->getRepository('GeekhubMainBundle:Post')->findAll();

        return $this->render('GeekhubMainBundle:Main:showPosts.html.twig', ['posts' => $posts]);
    }

    /**
     * Show specific post by Id
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPostAction($id)
    {
        $post = $this->getDoctrine()->getRepository('GeekhubMainBundle:Post')->find($id);

        return $this->render('GeekhubMainBundle:Main:showPost.html.twig', ['post' => $post]);
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
}
