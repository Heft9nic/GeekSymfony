<?php

namespace Geekhub\MainBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class LoadTestData implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     * @return $this
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $loader = $this->container->get('hautelook_alice.loader');
        $loader->load([__DIR__.'/fixtures.yml']);
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
