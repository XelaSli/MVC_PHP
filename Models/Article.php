<?php

include_once 'Config/Database.php';
include_once 'Models/Categories.php';
include_once 'Models/Tags.php';
include_once 'Models/Comment.php';

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
        $sql = "SELECT id, title, content, DATE_FORMAT(creation_date, '%Y-%m-%d') AS creation_date, DATE_FORMAT(edition_date, '%Y-%m-%d') AS edition_date, user_id, category_id FROM articles ORDER BY id DESC";
        //$sql = "SELECT * FROM articles ORDER BY creation_date DESC";
        $req = $this->database->query($sql);
        $res = $req->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function display_article($id)
    {
        // $sql = "SELECT articles.id, articles.title, articles.content, articles.creation_date, articles.edition_date, categories.category, users.username FROM categories INNER JOIN articles ON articles.category_id = categories.id INNER JOIN users ON articles.user_id = users.id WHERE articles.id= ?";
        $sql = "SELECT id, title, content, DATE_FORMAT(creation_date, '%Y-%m-%d') AS creation_date, DATE_FORMAT(edition_date, '%Y-%m-%d') AS edition_date, user_id, category_id FROM articles WHERE articles.id= ?";
        $req = $this->database->prepare($sql);
        $req->execute(array($id));
        $res = $req->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function display_article_tags($article_id)
    {
        $sql = "SELECT tag FROM tags INNER JOIN links ON tags.id = tag_id WHERE article_id =?";
        $req = $this->database->prepare($sql);
        $req->execute(array($article_id));
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return $res;

    }

    public function create_article($data)
    {
        $title = $data["title_article"];
        $content = nl2br($data["content_article"]);
        $cat = $data["category_select"];
        $user = $data["author"];
        $sql = "INSERT INTO articles (title,content, category_id, user_id) VALUES(?, ?, ?, ?)";
        $req = $this->database->prepare($sql);
        $res = $req->execute(array($title, $content, $cat, $user));
        foreach ($_POST as $val) {
            if (preg_match("#\##", $val)) {
                $tags_object = new Tags();
                $article_id = SELF::getLatestId();
                $tag_id = $tags_object->getTagId($val);
                $tags_object->assign_tags($tag_id, $article_id);
            }
        }
    }

    public function edit_article($id, $data)
    {
        $title = $data["new_title"];
        $content = nl2br($data["new_content"]);
        $cat = $data["new_category"];
        $sql = "UPDATE articles SET title= ?, content= ?, category_id = ?WHERE id= ?";
        $req = $this->database->prepare($sql);
        $req->execute(array($title, $content, $cat, $id));
        $data["existing_tags"] = explode(" ", $_POST["existing_tags"]);
        unset($data["existing_tags"][count($data["existing_tags"]) - 1]);
        foreach ($data["existing_tags"] as $val) {
            if (!in_array($val, $_POST)) {
                $tags_object = new Tags();
                $tag_id = $tags_object->getTagId($val);
                $tags_object->delete_article_tag($tag_id, $id);
            }
        }
        foreach ($_POST as $val) {
            if (preg_match("#\##", $val) && !preg_match("# #", $val)) {
                if (!in_array($val, $data["existing_tags"])) {
                    $tags_object = new Tags();
                    $tag_id = $tags_object->getTagId($val);
                    $tags_object->assign_tags($tag_id, $id);
                }
            }
        }
    }

    public function delete_article($id)
    {
        $sql = "DELETE FROM articles WHERE id=?";
        $req = $this->database->prepare($sql);
        $req->execute(array($id));
        $comment = new Comment();
        $req->closeCursor();
        $comment->delete_article_comments($id);
    }

    public function getLatestId()
    {
        $sql = "SELECT id FROM articles ORDER BY id DESC LIMIT 1";
        $req = $this->database->query($sql);
        $res = $req->fetch(PDO::FETCH_ASSOC);
        return ($res["id"]);
    }

    public function filter_articles($filter, $type)
    {
        switch (true) {
            case ($type == "Author"):
                $req = $this->database->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%Y-%m-%d') AS creation_date, DATE_FORMAT(edition_date, '%Y-%m-%d') AS edition_date, user_id, category_id FROM articles WHERE user_id = :filter ORDER BY id DESC");
                $req->execute(array(":filter" => $filter));
                $res = $req->fetchAll(PDO::FETCH_ASSOC);
                break;
            case ($type == "Date"):
                $req = $this->database->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%Y-%m-%d') AS creation_date, DATE_FORMAT(edition_date, '%Y-%m-%d') AS edition_date, user_id, category_id FROM articles WHERE creation_date LIKE :filter ORDER BY id DESC");
                $req->execute(array(":filter" => $filter . "%"));
                $res = $req->fetchAll(PDO::FETCH_ASSOC);
                break;
            case ($type == "Category"):
                $req = $this->database->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%Y-%m-%d') AS creation_date, DATE_FORMAT(edition_date, '%Y-%m-%d') AS edition_date, user_id, category_id FROM articles WHERE category_id = :filter ORDER BY id DESC");
                $req->execute(array(":filter" => $filter));
                $res = $req->fetchAll(PDO::FETCH_ASSOC);
                break;
            case ($type == "Tag"):
                $i = 0;
                $tags_object = new Tags();
                $articles = $tags_object->getArticleTagId($filter);
                foreach ($articles as $article) {
                    $req = $this->database->prepare("SELECT id, title, content, DATE_FORMAT(creation_date, '%Y-%m-%d') AS creation_date, DATE_FORMAT(edition_date, '%Y-%m-%d') AS edition_date, user_id, category_id FROM articles WHERE id = :filter ORDER BY id DESC");
                    $req->execute(array(":filter" => $article["article_id"]));
                    $res[$i] = $req->fetch(PDO::FETCH_ASSOC);
                    $i++;
                }
                break;
        }
        return ($res);
    }
}
