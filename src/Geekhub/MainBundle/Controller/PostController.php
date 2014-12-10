<?php

namespace Geekhub\MainBundle\Controller;

use Geekhub\MainBundle\Entity\Comment;
use Geekhub\MainBundle\Entity\Post;
use Geekhub\MainBundle\Entity\Tag;
use Geekhub\MainBundle\Form\Type\CommentType;
use Geekhub\MainBundle\Form\Type\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
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
     * Create post
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(new PostType(), $post);
        $form->handleRequest($request);
        if ($form->isValid()) {
            foreach ($form->getData()->getTagList() as $key => $value) {
                $tag = $this->getDoctrine()->getRepository('GeekhubMainBundle:Tag')->findOneBy(['tagName' => $value]);
                if ($tag == null) {
                    $tag = new Tag();
                    $tag->setTagName($value);
                }
                $tag->addPost($post);
                $post->addTag($tag);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

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
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

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
        $commentForm = $this->createForm(new CommentType(), $comment);
        $commentForm->handleRequest($request);
        if ($commentForm->isValid()) {
            $comment->setPost($post);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }

        return $this->render('GeekhubMainBundle:Post:show.html.twig', ['post' => $post, 'form' => $commentForm->createView()]);
    }
}
