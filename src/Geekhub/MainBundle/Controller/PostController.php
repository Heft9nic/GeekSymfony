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
        $posts = $this->get('geekhub.post_repository')->findBy([], ['createdAt' => 'DESC']);

        return $this->render('GeekhubMainBundle:Post:index.html.twig', ['posts' => $posts]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm('post', $post);
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
     * @param $slugTitle
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction($slugTitle, Request $request)
    {
        $post = $this->get('geekhub.post_repository')->findOneBy(['slug_title' => $slugTitle]);
        $form = $this->createForm('post', $post);
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
     * @param $slugTitle
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request, $slugTitle)
    {
        $post = $this->get('geekhub.post_repository')->findOneBy(['slug_title' => $slugTitle]);
        $comment = new Comment();
        $commentForm = $this->createForm('comment', $comment);
        $commentForm->handleRequest($request);
        if ($commentForm->isValid()) {
            $comment->setPost($post);
            $this->save($comment);
        }

        return $this->render('GeekhubMainBundle:Post:show.html.twig', ['post' => $post, 'form' => $commentForm->createView()]);
    }
}
