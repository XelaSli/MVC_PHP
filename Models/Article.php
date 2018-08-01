<?php

include_once '../Config/Database.php';

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

    public function create_article($title, $content = null, $cat = null)
    {
        if ($cat != null) {
            $cat = getCatName($cat);
        }
        $sql = "INSERT INTO articles (title,content, category_id) VALUES(?, ?, ?)";
        $req = $this->database->prepare($sql);
        $res = $req->execute(array($title, $content, $cat));
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

    public function add_category($cat)
    {
        $req = $this->database->prepare("SELECT category FROM categories WHERE category=:category;");
        $req->execute(array(":category" => $cat));
        if ($req->fetch() == false) {
            $req->closeCursor();
            $req = $this->database->prepare("INSERT INTO categories(category) VALUES(category=:category;");
            $req->execute(array(":category" => $cat));
        } else {
            echo "<p>This category already exists.</p>";
            return (false);
        }
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

    public function getCatName($cat){

    }

    public function assign_tags($tags)
    {

    }
}
