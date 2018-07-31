<?php
session_start();
require_once "../Models/Users.php";
$user = new Users();
if (isset($_SESSION["username"]) && isset($_SESSION["password"])) {
    require_once "../Views/Articles/blog.php";
} elseif (isset($_GET["action"]) && $_GET["action"] = "register") {
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password_confirmation"]) && isset($_POST["email"])) {
        $errors = 0;
        if (strlen($_POST["username"]) < 3 || strlen($_POST["username"]) > 10) {
            echo "<p>Invalid username.</p>";
            $errors++;

        }
        if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST["email"])) {
            echo "<p>Invalid email.</p>";
            $errors++;
        }
        if ($_POST["password"] != $_POST["password_confirmation"]) {
            echo "<p>Invalid password.</p>";
            $errors++;
        }
        if (strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 20) {
            echo "<p>Invalid password.</p>";
            $errors++;
        }
        if ($errors == 0) {
            $create = $user->create_user($_POST["username"], md5($_POST["password"]), $_POST["email"]);
            if ($create) {
                header("Location: UsersController.php");
            }
        }
    }
    require_once "../Views/Users/registration.php";
} elseif (isset($_GET["action"]) && $_GET["action"] = "logout") {
    $user->logout();
    header("Location: UsersController.php");
} else {
    if (isset($_POST["username_connect"]) && isset($_POST["password_connect"])) {
        $login = $user->log_in($_POST["username_connect"], $_POST["password_connect"]);
        if ($login) {
            header("Location: UsersController.php");
        }
    }
    require_once "../Views/Users/connexion.php";
}
