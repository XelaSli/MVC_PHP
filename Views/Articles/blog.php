<?php $title = "Blog";?>

<?php ob_start();?>
<header><?php include_once 'Views/menu.php';?></header>
<h1>Blog</h1>
<form method="get" action="UsersController.php">
<input type="hidden" value="create_article" id="action" name="action" />
<?php
if ($_SESSION["group"] != "User") {?>
<input type="submit" value="Add a new article" class="waves-effect blue darken-1 btn"/>
<?php }?>
</form>
<form method="get" action="UsersController.php">
<input type="hidden" value="manage_category" id="action" name="action" />
<?php
if ($_SESSION["group"] != "User") {?><br>
<input type="submit" value="Manage category / Tags" class="waves-effect blue darken-1 btn"/>
<?php }?>
</form>
<?php
if (empty($articleList)) {
    echo "<p>No articles yet.</p>";
}
?>
<?php
foreach ($articleList as $article) {
    ?>
<h3><?=$article["title"]?></h3>
<p><?=$article["content"]?></p>
<p><em>Written by <a href="UsersController.php?filter=<?=$article["user_id"] ?>&amp;type=Author"><?=$userController::getUser()->display_user($article["user_id"])["username"]?></a> on <a href="UsersController.php?filter=<?=$article["creation_date"] ?>&amp;type=Date"><?=$article["creation_date"]?></a></em></p>
<?php
if ($article["creation_date"] != $article["edition_date"]) {
        echo "<p><em>Last modification: " . $article["edition_date"] . "</em></p>";
    }
    ?>
    <p>Category: <a href="UsersController.php?filter=<?=$article["category_id"]?>&amp;type=Category"><?=$category_object->getCategory($article["category_id"])?></a></p>
<?php
$tags = $tags_object->getArticleTags($article["id"]);
    if ($tags != false) {
        echo "Tags: ";
        foreach ($tags as $tag) {
            echo "<a href='UsersController.php?filter=" . $tags_object->getTagId($tag["tag"]) . "&amp;type=Tag'>" . $tag["tag"] . "</a> ";
        }
    }
    if ($_SESSION["group"] != "User") {?>
    <p><a href="UsersController.php?action=edit_article&amp;id=<?=$article["id"]?>"><i class="material-icons">edit</i></a> - <a href="UsersController.php?action=delete_article&amp;id=<?=$article["id"]?>"><i class="material-icons">delete_forever</i></a></p>
    <?php
}
    $comment_object = new Comment();
    $comments = $comment_object->display_comments($article["id"]);
    if ($comments != false) {
        foreach ($comments as $comment) {
            if ($comment["username"] == $_SESSION["username"]) {
                echo "<p><strong>" . $comment["username"] . ": </strong>" . $comment["content"] . " <a href='UsersController.php?action=delete_comment&amp;id=" . $comment["id"] . "'>Delete comment</a></p>";
            } else {
                echo "<p><strong>" . $comment["username"] . ": </strong>" . $comment["content"];
            }

        }
    }
    ?>
<form method="post" action="UsersController.php?action=add_comment&amp;id=<?=$article["id"]?>">
<label for="comment">Add a comment: </label> <input type="hidden" name="author" id="author" value="<?=$userController::getUser()->getUserId($_SESSION["username"]);?>" /><input type="text" name="comment" id="comment" required /> <input type="submit" class="waves-effect blue darken-1 btn" value="Add" />
</form>
<?php
}
?>
<?php $content = ob_get_clean();?>

<?php require_once "Views/template.php";