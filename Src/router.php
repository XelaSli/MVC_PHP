<?php

class Router
{
    private $_ctrl;
    private $_view;

    public function routeReq()
    {
        require_once "Controllers/UsersController.php";
    }
}
