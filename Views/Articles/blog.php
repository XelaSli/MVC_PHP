<?php $title = "Blog";?>

<?php ob_start();?>
<header><?php include_once '../Views/menu.php';?></header>
<h1>Blog</h1>
<form method="get" action="UsersController.php">
<input type="hidden" value="create_article" id="action" name="action" />
<input type="submit" value="Add a new article" />
</form>
<?php
foreach ($articleList as $article) {
    ?>
<h2><?=$article["title"]?></h2>
<?php
}
?>
<?php $content = ob_get_clean();?>

<?php require_once "../Views/template.php";