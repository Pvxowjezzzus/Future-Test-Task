<?php


namespace app\core;


abstract class Controller
{
    public $view;
    public $route;
    public $model;
    public function __construct($route)
    {
        $this->route = $route;
        $this->model = $this->LoadModel($route['controller']);
        $this->view = new View($route);
        
    }

    public function LoadModel($name)
    {
        $path = 'app\models\\'.ucfirst($name);
        if(class_exists($path))
            return new $path($this->route);
    }

  
}