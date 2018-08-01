<?php
include_once '../Config/Database.php';

class Tags{
    private $database;

    public function __construct()
    {
        $connection = Database::getInstance();
        $this->database = $connection->getConnection();
    }

    public function getTags()
    {
        $sql = "SELECT tag FROM tags;";
        $req = $this->database->query($sql);
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return ($res);
    }
    
    public function create_tags($tags)
    {
        $tagList = explode(" ", $tags);
        foreach ($tagList as $tag) {
            $req = $this->database->prepare("SELECT tag FROM tags WHERE tag=:tag;");
            $req->execute(array(":category" => $tag));
            if ($req->fetch() == false) {
                $req->closeCursor();
                $req = $this->database->prepare("INSERT INTO tags(tag) VALUES(tag=:tag;");
                $req->execute(array(":tag" => $tag));
            }
        }
    }

    public function assign_tags($tags)
    {

    }
}