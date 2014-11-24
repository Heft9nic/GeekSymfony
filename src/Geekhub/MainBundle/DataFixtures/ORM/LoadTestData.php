<?php

namespace Geekhub\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadTestData implements FixtureInterface, OrderedFixtureInterface
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
        $loader = new \Nelmio\Alice\Loader\Yaml();
        $objects = $loader->load(__DIR__.'/fixtures.yml');
        $persister = new \Nelmio\Alice\ORM\Doctrine($manager);
        $persister->persist($objects);
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
