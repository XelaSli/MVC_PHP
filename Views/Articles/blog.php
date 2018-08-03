<?php $title = "Blog";?>

<?php ob_start();?>
<header><?php include_once 'Views/menu.php';?></header>
<h1>Blog</h1>
<form method="get" action="create_article">
<?php
if ($_SESSION["group"] != "User") {?>
<button class="waves-effect blue darken-1 btn"><input type="submit" value="Add a new article" /></button>
<?php }?>
</form>
<form method="get" action="manage_category">
<?php
if ($_SESSION["group"] != "User") {?><br>
<button class="waves-effect blue darken-1 btn"><input type="submit" value="Manage category / Tags"/></button>
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
<p><em>Written by <a href=".?filter=<?=$article["user_id"] ?>&amp;type=Author"><?=$userController::getUser()->display_user($article["user_id"])["username"]?></a> on <a href=".?filter=<?=$article["creation_date"] ?>&amp;type=Date"><?=$article["creation_date"]?></a></em></p>
<?php
if ($article["creation_date"] != $article["edition_date"]) {
        echo "<p><em>Last modification: " . $article["edition_date"] . "</em></p>";
    }
    ?>
    <p>Category: <a href=".?filter=<?=$article["category_id"]?>&amp;type=Category"><?=$category_object->getCategory($article["category_id"])?></a></p>
<?php
$tags = $tags_object->getArticleTags($article["id"]);
    if ($tags != false) {
        echo "Tags: ";
        foreach ($tags as $tag) {
            echo "<a href='.?filter=" . $tags_object->getTagId($tag["tag"]) . "&amp;type=Tag'>" . $tag["tag"] . "</a> ";
        }
    }
    if ($_SESSION["group"] != "User") {?>
    <p><a href="edit_article&amp;id=<?=$article["id"]?>"><i class="material-icons">edit</i></a> - <a href="delete_article&amp;id=<?=$article["id"]?>"><i class="material-icons">delete_forever</i></a></p>
    <?php
}
    $comment_object = new Comment();
    $comments = $comment_object->display_comments($article["id"]);
    if ($comments != false) {
        foreach ($comments as $comment) {
            if ($comment["username"] == $_SESSION["username"]) {
                echo "<p><strong>" . $comment["username"] . ": </strong>" . $comment["content"] . " <a href='delete_comment&amp;id=" . $comment["id"] . "'>Delete comment</a></p>";
            } else {
                echo "<p><strong>" . $comment["username"] . ": </strong>" . $comment["content"];
            }

        }
    }
    ?>
<form method="post" action="add_comment&amp;id=<?=$article["id"]?>">
<label for="comment">Add a comment: </label> <input width="50px" type="hidden" name="author" id="author" value="<?=$userController::getUser()->getUserId($_SESSION["username"]);?>" /><input type="text" name="comment" id="comment" required /> <button class="waves-effect blue darken-1 btn"><input type="submit"  value="Add" /></button>
</form><br>
<?php
}
?>
<?php $content = ob_get_clean();?>

<?php require_once "Views/template.php";