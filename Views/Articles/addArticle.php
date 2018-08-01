<?php $title = "Add an article"; ?>

<?php ob_start();?>
<h1>Add an article</h1>
<form method="post" action="ArticlesController.php">
<label for="title_article">Title: </label>
<input type="text" id="title_article" name="title_article" required /><br /><br />

<label for="content_article">Content: </label>
<textarea id="content_article" name="content_article" required></textarea><br /><br />

<label for="category_select">Select a category: </label>
<select id="category_select" name="category_select">
<option value=""></option>
<?php
foreach ($cats as $cat){
    echo "<option value='" . $cat["category"] . "'>" . $cat["category"] . "</option>";
}
?>
</select><br /><br />

<label for="article_tags">Tags: </label>
<input type="text" id="article_tags" name="article_tags" placeholder="Separate your tags with a space" /><br /><br />

<input type="submit" value="Add" />
</form>
<p><a href="UsersController.php">Back</a></p>
<?php $content = ob_get_clean();?>

<?php require_once "../Views/template.php";