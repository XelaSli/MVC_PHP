<?php

include_once '../Config/Database.php';

class Users
{
    
    private $database;
    
    public function __construct ()
    {
        $connection = Database::getInstance();
        $this->database=$connection->getConnection();
    }
    
    public function display_users()
    {
        $sql="SELECT * FROM users";
        $req=$this->database->query($sql);
        $res=$req->fetchAll(PDO::FETCH_ASSOC);
    var_dump($req);
        return $res;
    
    }
    
    public function display_user($id)
    {
        $sql="SELECT * FROM userss WHERE id= ?";
        $req =$this->database->prepare($sql);
        $req->execute(array($id));
        $res = $req->fetch(PDO::FETCH_ASSOC);
        return $res; 
    }
    
    public function create_user($username,$password,$email)
    {
        
        $sql = "INSERT INTO users (username,password,email) VALUES(?, ?, ?) ";
        $req=$this->database->prepare($sql);
        $req->execute(array($username,$password,$email));
        echo "User created";
    }
    
    public function edit_user($id,$username=null)
    {
        
    }
    
    public function delete_user($id)
    {
        
    }
}