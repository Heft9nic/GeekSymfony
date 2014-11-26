<?php

namespace Geekhub\MainBundle\DataFixtures\ORM;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

class TestDataLoader extends DataFixtureLoader
{
    /**
     * {@inheritDoc}
     */
    protected function getFixtures()
    {
        return  [
            __DIR__ . '/bundleFixtures.yml',
        ];
    }
}
