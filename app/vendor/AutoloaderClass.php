<?php

class AutoloaderClass
{
    private $rootDir;
    private $prefixes = ['App','Core','Vendor'];

    public function __construct()
    {
        $this->rootDir  = __DIR__ . DIRECTORY_SEPARATOR;
    }

    public function load()
    {
        spl_autoload_register([$this, 'loadByClass']);
    }

    public function loadByClass($className)
    {
        $prefix = explode('\\', $className)[0];
        if (!in_array($prefix, $this->prefixes)) {
            return;
        }
        
        $className = strtolower(substr($className, 0, 1)).substr($className, 1);
        $file = $this->rootDir.'../' . str_replace('\\', '/', $className) . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }

}

