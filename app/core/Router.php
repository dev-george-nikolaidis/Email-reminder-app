<?php

// Router class break the url to chunks and  map  to   needed controller 

class Router
{
    protected $currentController = "appointments";
    protected $currentMethod = "index";
    protected $params = [];


    public function __construct()
    {

        $url = $this->getUrl();


        if (isset($url[0])) {
            if (file_exists("../app/controllers/" .  ucwords($url[0]) . ".php")) {
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            } else {
                $this->currentController = "Errors";
                unset($url[0]);
            }
        }


        require_once "../app/controllers/" . $this->currentController . ".php";

        // instantiate controller class 
        $this->currentController  = new $this->currentController;

        // check for method to map in the controller
        if (isset($url[1])) {
            // check if method exists in the controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        //Get rest params
        $this->params = $url ? array_values($url) : [];

        // call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function  getUrl()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            return $url;
        }
    }
}
