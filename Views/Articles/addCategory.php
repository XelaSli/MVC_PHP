<?php $title = "Add a category"; ?>


<?php ob_start();?>
<h1>Add an category</h1>
<form method="post" action="ArticlesController.php">
<label for="category_article">Name: </label>
<input type="text" id="category_article" name="category_article" required /><br /><br />
<br /><br />