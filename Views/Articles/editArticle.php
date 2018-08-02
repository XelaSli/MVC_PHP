<?php $title = "Edit an article";?>

<?php ob_start();?>
<h1>Edit an article</h1>
<form method="post" action="UsersController.php?action=edit_article&amp;id=<?=$_GET["id"]?>">
<label for="new_title">Title: </label>
<input type="text" id="new_title" name="new_title" value="<?=$article_data["title"]?>"required /><br /><br />

<label for="new_content">Content: </label>
<textarea id="new_content" name="new_content" required><?= $article_data["content"];?></textarea><br /><br />

<label for="new_category">Category: </label>
<select id="new_category" name="new_category" required >
<option value=""></option>
<?php
foreach ($cats as $cat) {
    if ($cat["id"] == $article_data["category_id"]) {
        echo "<option value='" . $cat["category"] . "' selected>" . $cat["category"] . "</option>";
    } else {
        echo "<option value='" . $cat["category"] . "'>" . $cat["category"] . "</option>";
    }
}
?>
</select><br /><br />

<label>Tags: </label>
<?php
foreach ($tags as $tag) {
    // if ($tags_article["tag"] == $tag["tag"])
    if (in_array($tag["tag"], $tags_article)) {
        echo "<input type='checkbox' name='" . $tag["tag"] . "' value='" . $tag["tag"] . "' checked />";
    } else {
        echo "<input type='checkbox' name='" . $tag["tag"] . "' value='" . $tag["tag"] . "' />";
    }

    echo "<label for='" . $tag["tag"] . "' /> " . $tag["tag"] . "</label> ";
}
?>
<br /><br />
<input type="hidden" value="<?=$userController::getUser()->getUserId($_SESSION["username"]);?>" name="author" id="author" />
<input type="hidden" value="<?php
foreach ($tags_article as $tag_article) {
    echo $tag_article . " ";
}
?>" name="existing_tags" id="existing_tags" />
<input type="submit" value="Edit" />
</form>
<p><a href="UsersController.php">Back</a></p>
<?php $content = ob_get_clean();?>

<?php require_once "../Views/template.php";
