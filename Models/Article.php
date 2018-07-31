<?php

include_once '../Config/Database.php';

class Article
{
    
    private $database;
    
    public function __construct ()
    {
        $connection = Database::getInstance();
        $this->database=$connection->getConnection();
    }


    public function display_articles()
    {
        $sql="SELECT * FROM articles";
        $req=$this->database->query($sql);
        $res=$req->fetchAll(PDO::FETCH_ASSOC);
   
        return $res;
    
    }
    
    public function display_article($id)
    {
        $sql="SELECT * FROM articles WHERE id= ?";
        $req =$this->database->prepare($sql);
        $req->execute(array($id));
        $res = $req->fetch(PDO::FETCH_ASSOC);
        return $res; 
    }
    
    public function create_article($username,$password,$email)
    {
        
        $sql = "INSERT INTO articles (username,password,email,`group`,banned) VALUES(?, ?, ?, 0, 1)";
        $req=$this->database->prepare($sql);
        $res = $req->execute(array($username,$password,$email));
        echo "Article created";
    }
    
    public function edit_article($id,$username=null,$password=null,$email=null)
    {
        $sql= "UPDATE users SET username= ?, password= ?, email = ?, edition_date = NOW() WHERE id= ?";
        $req= $this->database->prepare($sql);
        $req->execute(array($username,$password,$email,$id));
        echo "Update article successfull.";   
    }
    
    public function delete_article($id)
    {
        $sql="DELETE FROM users WHERE id=?";
        $req=$this->database->prepare($sql);
        $req->execute(array($id));
        echo"Delete article Successfull.";
    }
}