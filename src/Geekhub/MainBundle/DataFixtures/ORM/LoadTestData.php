<?php

namespace Geekhub\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Geekhub\MainBundle\Entity\Post;
use Geekhub\MainBundle\Entity\Comment;


class LoadTestData implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 3; $i++) {
            $post  = new Post();
            $post->setTitle('Post ' . $i . ' title');
            $post->setContent('Post ' . $i . ' content');
            $manager->persist($post);
            if ($i == 1) {
                for ($j = 1; $j < 3; $j++) {
                    $comment = new Comment();
                    $comment->setPost($post);
                    $comment->setTitle('Comment ' . $j . ' title');
                    $comment->setContent('Test ' . $j . 'comment');
                    $manager->persist($comment);
                }
            }
        }
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
