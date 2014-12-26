<?php

namespace Geekhub\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class Builder
{

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
            'childrenAttributes' => array(
                'id' => 'menu',
            ),
        ));
        $menu->addChild('menu.main', array('route' => 'welcome_page'))->setExtra('translation_domain', 'messages');
        $menu->addChild('menu.posts', array('route' => 'posts_index'))->setExtra('translation_domain', 'messages');
        $menu->addChild('menu.twig', array('route' => 'test_twig'))->setExtra('translation_domain', 'messages');
        $menu->addChild('menu.many_to_many', array('route' => 'many_to_many'))->setExtra('translation_domain', 'messages');

        return $menu;
    }
}
