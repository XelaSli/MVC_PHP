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
$tags = $tags_object->getTags();
$cats = $category_object->getCategories();

if (isset($_GET["action"]) && $_GET["action"] == "create_article") {
    require_once "../Views/Articles/addArticle.php";
} elseif (isset($_GET["action"]) && $_GET["action"] == "delete_article") {
    $articleController->getArticle()->delete_article($_GET["id"]);
} elseif (isset($_GET["action"]) && $_GET["action"] == "edit_article") {
    if (isset($_GET["id"]) && $_GET["id"] != "") {
        $article_data = $articleController->getArticle()->display_article($_GET["id"]);
        $article_data["content"] = str_replace("&lt;br /&gt;", "", $article_data["content"]);
        // $article_data["content"] = str_replace("&lt;br/&gt;","",$article_data["content"]);
        // $article_data["content"] = str_replace("&lt;br&gt;","",$article_data["content"]);
        $tags_article = $tags_object->getArticleTags($_GET["id"]);
        if ($tags_article != false) {
            $i = 0;
            $tmp;
            foreach ($tags_article as $tag_article) {
                $tmp[$i] = $tag_article["tag"];
                $i++;
            }
            $tags_article = $tmp;
        }
        if (isset($_POST["new_title"])) {
            $_POST["new_category"] = $category_object->getCatId($_POST["new_category"]);
            $articleController->getArticle()->edit_article($_GET["id"], $_POST);
            header("Location: UsersController.php");
        }
        require_once "../Views/Articles/editArticle.php";
    } else {
        header("Location: UsersController.php");
    }

} elseif (isset($_POST["title_article"]) && isset($_POST["content_article"]) && isset($_POST["category_select"])) {
    $_POST["category_select"] = $category_object->getCatId($_POST["category_select"]);
    $articleController->getArticle()->create_article($_POST);
    header("Location: UsersController.php");
}
require_once "../Views/Articles/blog.php";
