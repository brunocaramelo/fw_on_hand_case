<?php

namespace Core;

class Redirect
{
    private $sessionContext = null;

    public function __construct(Session $session)
    {
        $this->sessionContext = $session;
    }

    public function route($url, $with = [])
    {
        if (count($with) > 0) {
            foreach ($with as $key => $value) {
                $this->sessionContext->set($key, $value);
            }
        }
        return header("location:$url");
    }
}
