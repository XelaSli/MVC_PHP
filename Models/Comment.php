<?php

include_once 'Config/Database.php';
include_once 'Models/Article.php';

class Comment
{
    private $database;

    public function __construct()
    {
        $connection = Database::getInstance();
        $this->database = $connection->getConnection();
    }

    public function create_comment($user_id, $article_id, $comment)
    {
        $sql = "INSERT INTO comments (user_id, article_id, content) VALUES (?, ?, ?)";
        $req = $this->database->prepare($sql);
        $res = $req->execute(array($user_id, $article_id, $comment));
    }

    public function delete_comment($comment_id)
    {
        $sql = "DELETE FROM comments WHERE id=?";
        $req = $this->database->prepare($sql);
        $req->execute(array($comment_id));
    }

    public function delete_article_comments($article_id)
    {
        $sql = "DELETE FROM comments WHERE article_id=?";
        $req = $this->database->prepare($sql);
        $req->execute(array($article_id));
        header("Location: .");
    }

    public function display_comments($article_id)
    {
        $sql = "SELECT comments.id, comments.content, users.username FROM comments INNER JOIN users ON users.id = comments.user_id WHERE article_id=? ORDER BY comments.creation_date ASC";
        $req = $this->database->prepare($sql);
        $req->execute(array($article_id));
        $res = $req->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

}
