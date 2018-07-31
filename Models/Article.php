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
    
    public function create_article($title, $content=null)
    {
        
        $sql = "INSERT INTO articles (title,content) VALUES(?, ?)";
        $req=$this->database->prepare($sql);
        $res = $req->execute(array($title,$content));
        echo "Article created";
    }
    
    public function edit_article($id,$title=null,$content=null)
    {
        $sql= "UPDATE articles SET title= ?, content= ?, edition_date = NOW() WHERE id= ?";
        $req= $this->database->prepare($sql);
        $req->execute(array($title,$description,$id));
        echo "Update article successfull.";   
    }
    
    public function delete_article($id)
    {
        $sql="DELETE FROM articles WHERE id=?";
        $req=$this->database->prepare($sql);
        $req->execute(array($id));
        echo"Delete article Successfull.";
    }
}