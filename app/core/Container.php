<?php

namespace Core;

class Container
{

    protected $instances = null;

    public function register($alias, $instance)
    {
        $this->instances[$alias] = $instance;
        return $this;
    }

    public function get($alias)
    {
        return $this->instances[$alias];
    }

}
