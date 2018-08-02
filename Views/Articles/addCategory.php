<?php $title = "Add a category"; ?>


<?php ob_start();?>
<h1>Add an category</h1>
<form method="post" action="ArticlesController.php">
<label for="category_name">Name: </label>
<input type="text" id="category_name" name="category_name" required /><br /><br />
<br /><br />

<?php require_once "../Views/template.php";