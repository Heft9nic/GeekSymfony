<?php

namespace Geekhub\MainBundle\Services;

class SimpleService
{

    /**
     * @param $name
     * @return string
     */
    public function returnServiceName($name)
    {
        return 'My First Service in work with argument from URL - ' . $name;
    }
}
