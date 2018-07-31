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
        
        $sql = "INSERT INTO users (username,password,email,`group`,banned) VALUES(?, ?, ?, 0, 1)";
        $req=$this->database->prepare($sql);
        $res = $req->execute(array($username,$password,$email));
        echo "User created";
    }
    
    public function edit_user($id,$username=null,$password=null,$email=null)
    {
        $sql= "UPDATE users SET username= ?, password= ?, email = ?, edition_date = NOW() WHERE id= ?";
        $req= $this->database->prepare($sql);
        $req->execute(array($username,$password,$email,$id));
        echo "Update successfull.";   
    }
    
    public function delete_user($id)
    {
        $sql="DELETE FROM users WHERE id=?";
        $req=$this->database->prepare($sql);
        $req->execute(array($id));
        echo"Delete Successfull.";
    }
}