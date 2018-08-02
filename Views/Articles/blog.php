<?php $title = "Blog";?>

<?php ob_start();?>
<header><?php include_once '../Views/menu.php';?></header>
<h1>Blog</h1>
<form method="get" action="UsersController.php">
<input type="hidden" value="create_article" id="action" name="action" />
<input type="submit" value="Add a new article" />
</form>
<?php
if (empty($articleList)) {
    echo "<p>No articles yet.</p>";
}
?>
<?php
foreach ($articleList as $article) {
    ?>
<h2><?=$article["title"]?></h2>
<p><?=$article["content"]?></p>
<p><em>Written by <?=$userController::getUser()->display_user($article["user_id"])["username"]?> on <?=$article["creation_date"]?></em></p>
<?php
if ($article["creation_date"] != $article["edition_date"]) {
        echo "<p><em>Last modification: " . $article["edition_date"] . "</em></p>";
    }
    ?>
    <p>Category: <?=$category_object->getCategory($article["category_id"])?></p>
<?php
$tags = $tags_object->getArticleTags($article["id"]);
    if ($tags != false) {
        echo "Tags: ";
        foreach ($tags as $tag) {
            echo $tag["tag"] . " ";
        }
    }
    ?>
    <p><a href="UsersController.php?action=edit_article&amp;id=<?=$article["id"]?>">Edit article</a> - <a href="UsersController.php?action=delete_article&amp;id=<?=$article["id"]?>">Delete article</a></p>
    <?php
    $comment_object = new Comment();
    $comments = $comment_object->display_comments($article["id"]);
    if ($comments != false) {
        foreach ($comments as $comment) {
            echo "<p><strong>" . $comment["username"] . ": </strong>" . $comment["content"] . " <a href='UsersController.php?action=delete_comment&amp;id=" . $comment["id"] . "'>Delete comment</a></p>";
        }
    }
    ?>
<form method="post" action="UsersController.php?action=add_comment&amp;id=<?=$article["id"]?>">
<label for="comment">Add a comment: </label> <input type="hidden" name="author" id="author" value="<?=$userController::getUser()->getUserId($_SESSION["username"]);?>" /><input type="text" name="comment" id="comment" required /> <input type="submit" value="Add" />
</form>
<?php
}
?>
<?php $content = ob_get_clean();?>

<?php require_once "../Views/template.php";