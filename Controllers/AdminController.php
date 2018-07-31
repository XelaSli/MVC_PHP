<?php
session_start();
require_once "../Models/Users.php";

class AdminController
{

    public function __construct(){

        $this->Usermodel= new Users();
    }
    

    // public function createUser()
    // {
    //     $this->Usermodel->create_user($username, md5($password), $email);
        
        
    // }
}

if(isset($_GET['action']) && $_GET['action'] == 'admin')
    {
        $this->Usermodel->display_users();
        require_once "../Views/Users/admin.php";

    }
