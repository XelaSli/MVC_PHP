<?php
require_once "../Models/Article.php";

class ArticleController
{
    private static $article;
    private static $articleController;

    private function __construct()
    {}

    public static function getArticleController()
    {
        if (is_null(self::$articleController)) {
            self::$articleController = new ArticleController();
        }
        return self::$articleController;
    }

    public static function getArticle()
    {
        if (is_null(self::$article)) {
            self::$article = new Article();
        }
        return self::$article;
    }

    public function displayArticleList()
    {
        $articleList = SELF::getArticle()->display_articles();

        return ($articleList);
    }

    // public static function register($username, $password, $password_confirmation, $email)
    // {
    //     $errors = 0;
    //     if (strlen($username) < 3 || strlen($username) > 10) {
    //         echo "<p>Invalid username.</p>";
    //         $errors++;

    //     }
    //     if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) {
    //         echo "<p>Invalid email.</p>";
    //         $errors++;
    //     }
    //     if ($password != $password_confirmation) {
    //         echo "<p>Invalid password.</p>";
    //         $errors++;
    //     }
    //     if (strlen($password) < 8 || strlen($password) > 20) {
    //         echo "<p>Invalid password.</p>";
    //         $errors++;
    //     }
    //     if ($errors == 0) {
    //         SELF::getUser();
    //         $create = SELF::$user->create_user($username, md5($password), $email);
    //         if ($create) {
    //             header("Location: UsersController.php");
    //         }
    //     }
    // }
}
$articleController = ArticleController::getArticleController();
$articleList = $articleController->displayArticleList();
$category_object = new Categories();
$tags_object = new Tags();

if (isset($_GET["action"]) && $_GET["action"] == "create_article") {
    $tags = $tags_object->getTags();
    $cats = $category_object->getCategories();
    require_once "../Views/Articles/addArticle.php";
} elseif (isset($_POST["title_article"]) && isset($_POST["content_article"]) && isset($_POST["category_select"])) {
    $_POST["category_select"] = $category_object->getCatId($_POST["category_select"]);
    $articleController->getArticle()->create_article($_POST);
    header("Location: UsersController.php");
}
require_once "../Views/Articles/blog.php";
