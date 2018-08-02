<?php
include_once '../Config/Database.php';

class Tags
{
    private $database;

    public function __construct()
    {
        $connection = Database::getInstance();
        $this->database = $connection->getConnection();
    }

    public function getTags()
    {
        $sql = "SELECT tag FROM tags ORDER BY tag;";
        $req = $this->database->query($sql);
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return ($res);
    }

    public function getArticleTags($id)
    {
        $sql = "SELECT tags.tag FROM tags INNER JOIN links ON tags.id = links.tag_id WHERE links.article_id = :id;";
        $req = $this->database->prepare($sql);
        $req->execute(array(":id" => $id));
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

    public function delete_tag($id)
    {
        $sql = "DELETE FROM tags WHERE id=?";
        $req = $this->database->prepare($sql);
        $req->execute(array($id));
        echo "<p>This tag has been deleted.</p>";
        echo "<p><a href=''>OK</a></p>";
    }

    public function delete_article_tag($id, $article_id)
    {
        $sql = "DELETE FROM links WHERE tag_id = ? AND article_id = ?";
        $req = $this->database->prepare($sql);
        $req->execute(array($id, $article_id));
    }

    public function assign_tags($tag_id, $article_id)
    {
        var_dump($tag_id);
        $req = $this->database->prepare("SELECT id FROM links WHERE tag_id = :tag AND article_id = :article;");
        $req->execute(array(":tag" => $tag_id, ":article" => $article_id));
        if ($req->fetch() == false) {
            $req->closeCursor();
            $sql = "INSERT INTO links(tag_id, article_id) VALUES (:tag_id, :article_id)";
            $req = $this->database->prepare($sql);
            $req->execute(array(":tag_id" => $tag_id, ":article_id" => $article_id));
        }
    }

    public function getTagId($tag)
    {
        $req = $this->database->prepare("SELECT id FROM tags WHERE tag=:tag;");
        $req->execute(array(":tag" => $tag));
        $res = $req->fetch(PDO::FETCH_ASSOC);
        return ($res['id']);
    }
}
