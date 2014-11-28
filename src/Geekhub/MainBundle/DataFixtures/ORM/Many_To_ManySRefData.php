<?php

namespace Geekhub\MainBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

class Many_To_ManySRefData extends DataFixtureLoader
{
    /**
     * {@inheritDoc}
     */
    protected function getFixtures()
    {
        return  [
            __DIR__ . '/many_to_many.yml',
        ];
    }
}
