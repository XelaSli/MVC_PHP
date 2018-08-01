<?php

include_once '../Config/Database.php';
include_once '../Models/Categories.php';
include_once '../Models/Tags.php';

class Article
{

    private $database;

    public function __construct()
    {
        $connection = Database::getInstance();
        $this->database = $connection->getConnection();
    }

    public function display_articles()
    {
        $sql = "SELECT * FROM articles ORDER BY creation_date DESC";
        $req = $this->database->query($sql);
        $res = $req->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function display_article($id)
    {
        $sql = "SELECT * FROM articles WHERE id= ?";
        $req = $this->database->prepare($sql);
        $req->execute(array($id));
        $res = $req->fetch(PDO::FETCH_ASSOC);
        return $res;
    }



    public function create_article($title, $content, $cat, $user)
    {
        $sql = "INSERT INTO articles (title,content, category_id, user_id) VALUES(?, ?, ?, ?)";
        $req = $this->database->prepare($sql);
        $res = $req->execute(array($title, $content, $cat, $user));
        echo "Article created";
    }

    public function edit_article($id, $title = null, $content = null)
    {
        $sql = "UPDATE articles SET title= ?, content= ?, edition_date = NOW() WHERE id= ?";
        $req = $this->database->prepare($sql);
        $req->execute(array($title, $description, $id));
        echo "Article successfully updated.";
    }

    public function delete_article($id)
    {
        $sql = "DELETE FROM articles WHERE id=?";
        $req = $this->database->prepare($sql);
        $req->execute(array($id));
        echo "Article successfully deleted.";
    }

    public function getLatestId(){
        $sql = "SELECT id FROM articles ORDER BY id DESC LIMIT 1";
        $req = $this->database->query($sql);
        $res = $req->fetch(PDO::FETCH_ASSOC);
        return ($res["id"]);
    }
}
