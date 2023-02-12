<?php

class Errors extends Controller
{

    public function __construct()
    {
    }


    public function index()
    {
        $data = [
            "page-title" => "Not Found",
        ];

        $this->view("errors/404", $data);
    }


    public function forbidden()
    {
        $data = [
            "page-title" => "Forbidden"
        ];
        $this->view("errors/403", $data);
    }


    public function databaseConnectionFailed()
    {
        $data = [
            "page-title" => "Server Error"
        ];
        $this->view("errors/500", $data);
    }
}
