<?php

namespace Core;

class ViewModel
{
    private $variables = [];
    private $titlePage = null;
    private $useLayout = false;
    private $layoutPath = 'layout';
    private $viewPath = null;
    private $auth = null;
    private $session = null;
    private $extractedVars = false;

    public function __construct($auth, $session)
    {
        $this->auth = $auth;
        $this->session = $session;
    }

    public function setup(array $variables, $template, $title)
    {
        $this->variables =  $variables;
        $this->viewPath = $template;
        $this->titlePage = $title;
        return $this;
    }

    public function setUseLayout($useLayout)
    {
        $this->useLayout = $useLayout;
        return $this;
    }

    public function setLayout($layoutName)
    {
        $this->useLayout = true;
        $this->layoutPath = $layoutName;
        return $this;
    }
    
    private function mergeVarsTemplate()
    {
        $fixedVars = ['auth' => $this->auth,
                     'titlePage' => $this->titlePage,
                     'session' => $this->session
                    ];

        $this->variables = array_merge($this->variables, $fixedVars);
    }

    public function render()
    {
        $this->mergeVarsTemplate();
        if ($this->useLayout === true) {
            return $this->layout();
        }

        return $this->content();
    }

    protected function content()
    {
        extract($this->variables);
       
        if (!file_exists(__DIR__."/../views/{$this->viewPath}.phtml")) {
            echo "Error: View path not found!";
            return;
        }
        return require __DIR__."/../views/{$this->viewPath}.phtml";
    }

    protected function layout()
    {
        extract($this->variables);

        if (!file_exists(__DIR__."/../views/{$this->layoutPath}.phtml")) {
            echo "Error: Layout path not found!";
            return;
        }
        return require __DIR__."/../views/{$this->layoutPath}.phtml";
    }
}
