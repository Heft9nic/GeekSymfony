<?php

namespace Geekhub\MainBundle\Controller;

use Geekhub\BaseBundle\Controller\BaseController;
use Geekhub\MainBundle\Entity\Comment;
use Geekhub\MainBundle\Entity\Post;
use Geekhub\MainBundle\Form\Type\PostType;
use Symfony\Component\HttpFoundation\Request;

class PostController extends BaseController
{
    /**
     * Show all posts of application
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository('GeekhubMainBundle:Post')->findBy([], ['id' => 'DESC']);

        return $this->render('GeekhubMainBundle:Post:index.html.twig', ['posts' => $posts]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->save($post);

            return $this->redirect($this->generateUrl('show_post', ['slug_title' => $post->getSlugTitle()]));
        }

        return $this->render('GeekhubMainBundle:Post:create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * Update post by slug
     *
     * @param Request $request
     * @param $slug_title
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($slug_title, Request $request)
    {
        $post = $this->getDoctrine()->getRepository('GeekhubMainBundle:Post')->findOneBy(['slug_title' => $slug_title]);
        $form = $this->createForm(new PostType(), $post);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->save($post);

            return $this->redirect($this->generateUrl('show_post', ['slug_title' => $post->getSlugTitle()]));
        }

        return $this->render('GeekhubMainBundle:Post:update.html.twig', ['form' => $form->createView()]);
    }

    /**
     * Show specific post by Id
     *
     * @param Request $request
     * @param $slug_title
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request, $slug_title)
    {
        $post = $this->getDoctrine()->getRepository('GeekhubMainBundle:Post')->findOneBy(['slug_title' => $slug_title]);
        $comment = new Comment();
        $commentForm = $this->createForm($this->get('geekhub.form.type.comment'), $comment);
        $commentForm->handleRequest($request);
        if ($commentForm->isValid()) {
            $comment->setPost($post);
            $this->save($comment);
        }

        return $this->render('GeekhubMainBundle:Post:show.html.twig', ['post' => $post, 'form' => $commentForm->createView()]);
    }
}
