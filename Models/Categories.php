<?php
include_once '../Config/Database.php';

class Categories{
    private $database;

    public function __construct()
    {
        $connection = Database::getInstance();
        $this->database = $connection->getConnection();
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

    public function getCategories()
    {
        $sql = "SELECT category FROM categories;";
        $req = $this->database->query($sql);
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
        return ($res);
    }

    public function getCatName($cat)
    {

    }
}