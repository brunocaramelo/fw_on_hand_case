<?php

namespace Core;

class ConfigParser
{
    public function get($configName)
    {
        return require __DIR__.'/../config/'.$configName.'.php';
    }
}
