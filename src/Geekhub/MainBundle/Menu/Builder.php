<?php

namespace Geekhub\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class Builder {

    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root', array(
            'childrenAttributes'    => array(
                'id'             => 'menu',
            ),
        ));
        $menu->addChild('Main', array('route' => 'welcome_page'));
        $menu->addChild('Posts(Doctrine)', array('route' => 'posts_index'));
        $menu->addChild('Twig(Twig Examples)', array('route' => 'test_twig'));
        $menu->addChild('ManyToMany(self_referencing)', array('route' => 'many_to_many'));

        return $menu;
    }
}
