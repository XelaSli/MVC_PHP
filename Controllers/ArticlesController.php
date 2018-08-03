<?php
require_once "Models/Article.php";

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
    //             header("Location: index.php");
    //         }
    //     }
    // }
}
$articleController = ArticleController::getArticleController();

$category_object = new Categories();
$tags_object = new Tags();
$tags = $tags_object->getTags();
$cats = $category_object->getCategories();


if (isset($_GET["filter"]) && isset($_GET["type"])) {
        $articleList = $articleController::getArticle()->filter_articles($_GET["filter"], $_GET["type"]);
}
else{
    $articleList = $articleController->displayArticleList();
}

if (isset($_GET["action"]) && $_GET["action"] == "create_article" && ($_SESSION["group"] != "User")) {
    require_once "Views/Articles/addArticle.php";
} elseif (isset($_GET["action"]) && $_GET["action"] == "delete_article" && ($_SESSION["group"] != "User")) {
    $articleController->getArticle()->delete_article($_GET["id"]);
} elseif (isset($_GET["action"]) && $_GET["action"] == "add_comment") {
    if (isset($_GET["id"]) && isset($_POST["comment"])) {
        $comment_object = new Comment();
        $comment_object->create_comment($_POST["author"], $_GET["id"], $_POST["comment"]);
        header("Location: .");
    }
} elseif (isset($_GET["action"]) && $_GET["action"] == "delete_comment") {
    if (isset($_GET["id"])) {
        $comment_object = new Comment();
        $comment_object->delete_comment($_GET["id"]);
        header("Location: .");
    }
} elseif (isset($_GET["action"]) && $_GET["action"] == "manage_category" && ($_SESSION["group"] != "User")) {
    require_once "Views/Articles/manageCategory.php";
}

elseif (isset($_GET["action"]) && $_GET["action"] == "edit_article" && ($_SESSION["group"] != "User")) {
    if (isset($_GET["id"]) && $_GET["id"] != "") {
        $article_data = $articleController->getArticle()->display_article($_GET["id"]);
        $article_data["content"] = preg_replace("#\<br /\>#", "", $article_data["content"]);
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
            header("Location: .");
        }
        require_once "Views/Articles/editArticle.php";
    } else {
        header("Location: .");
    }

} elseif (isset($_POST["title_article"]) && isset($_POST["content_article"]) && isset($_POST["category_select"])) {
    $_POST["category_select"] = $category_object->getCatId($_POST["category_select"]);
    $articleController->getArticle()->create_article($_POST);
    header("Location: .");

}elseif (isset($_POST["title_category"])) {
    //var_dump($_POST);
    $category_object->add_category($_POST['title_category']);
    header("Location: manage_category");

}elseif (isset($_POST["title_tag"])) {
    //var_dump($_POST);
    $tags_object->create_tags($_POST['title_tag']);
    header("Location: manage_category");
}
elseif (isset($_GET["action"]) && $_GET["action"] == "delete_tag" && isset($_GET["id"])) {
    $id=$_GET['id'];
       $tags_object->delete_tag($id);
       header("Location: manage_category");
}
elseif (isset($_GET["action"]) && $_GET["action"] == "delete_category" && isset($_GET["id"])) {
    $id=$_GET['id'];
       $category_object->delete_category($id);
       header("Location: manage_category");
}
elseif (isset($_GET["action"]) && $_GET["action"] == "edit_category" && isset($_GET["id"])) {
    $id=$_GET['id'];
       $category_object->edit_category($id);
       header("Location: manage_category");
} 
require_once "Views/Articles/blog.php";
