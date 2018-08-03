<?php

class Router
{
    private $_ctrl;
    private $_view;
    private static $actions = ["logout", "profile", "create_article", "manage_category", "create_user", "edit_user", "delete_user", "delete", "admin", "delete_article", "edit_article", "add_comment", "delete_comment", "register", "edit_category", "delete_category", "delete_tag"];

    public function routeReq()
    {
        $url = "";
        if (isset($_GET["url"]) && $_GET["url"] != "") {
            $url = explode("/", filter_var($_GET["url"]), FILTER_SANITIZE_URL);
            if (in_array($url[0], SELF::$actions)) {
                $_GET["action"] = $url[0];
                require_once "Controllers/UsersController.php";
            }
        } else {
            require_once "Controllers/UsersController.php";
        }
    }
}
