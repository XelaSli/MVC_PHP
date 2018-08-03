<?php
require_once "Models/Users.php";

class AdminController
{
    private static $admin;
    private static $adminController;
    
    private function __construct(){
        
    }
    
    public static function getAdminController()
    {
        if (is_null(self::$adminController)) {
            self::$adminController = new AdminController();
        }
        return self::$adminController;
    }
    
    public static function getAdmin()
    {
        if (is_null(self::$admin)) {
            self::$admin = new Users();
        }
        return self::$admin;
    }
    
    public function displayUserList(){
        $userList = SELF::getAdmin()->display_users();
        //var_dump($userList);
        return ($userList);
    }

    public function displayUser($id){
    
        $user = SELF::getAdmin()->display_user($id);
        return ($user);
    }

    public function editUser($id, $username, $email, $group, $banned)
    {
        $user= SELF::getAdmin()->edit_user($id, $username, $email, $group, $banned);
    }
    
    public static function register($username, $password, $password_confirmation, $email,$group)
    {
        $errors = 0;
        if (strlen($username) < 3 || strlen($username) > 10) {
            echo "<p>Invalid username.</p>";
            $errors++;
            
        }
        if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) {
            echo "<p>Invalid email.</p>";
            $errors++;
        }
        if ($password != $password_confirmation) {
            echo "<p>Invalid password.</p>";
            $errors++;
        }
        if (strlen($password) < 8 || strlen($password) > 20) {
            echo "<p>Invalid password.</p>";
            $errors++;
        }
        
        if ($errors == 0) {
            
            SELF::getAdmin();
            $create = SELF::$admin->create_user($username, md5($password), $email, $group);
            // if ($create) {
            //     header("Location: Views/Users/admin.php");
            // }
        }
    }
}
$adminController = AdminController::getAdminController();
$userList = $adminController->displayUserList();

if (isset($_GET["action"]) && $_GET["action"] == "create_user"){
    require_once("Views/Users/createUser.php");

    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password_confirmation"]) && isset($_POST["email"])) {
        
        $adminController::register($_POST["username"], $_POST["password"], $_POST["password_confirmation"], $_POST["email"], $_POST["group"]);
        
    }
    
}
if (isset($_GET["action"]) && $_GET["action"] == "delete_user" && isset($_GET["id"])) {
    $id=$_GET['id'];
        $user=$adminController->getAdmin()->delete_user($id, 1);
        header("Location: ./admin");
} 

if (isset($_GET["action"]) && $_GET["action"] == "edit_user"){
    
    $id=$_GET['id'];
    $user=$adminController->displayUser($id);
    
    
    if (isset($_POST["username"]) && isset($_POST["email"])) {
        $adminController::editUser($id, $_POST["username"], $_POST["email"], $_POST["group"],$_POST["banned"]);
        header("Location: ./admin");
    }
    require_once("Views/Users/editUser.php");
}
require_once("Views/Users/admin.php");