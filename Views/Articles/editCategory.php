<?php $title = "Edit an article";?>

<?php ob_start();?>
<h1>Edit a category</h1>
<form method="post" action="./edit_category&amp;id=<?= $_GET["id"]?>">
<label for="category">Category name:   </label>
<input type="text" id="category" name="category" value="<?= $category_object->getCategory($_GET["id"]) ?>" required>
<br><br>
<button  type="submit" class="waves-effect blue darken-1 btn" name="submit">Modify</button>
</form><br>
<button  type="button" class="waves-effect blue darken-1 btn" onclick="location.href='./manage_category'">Back</button><br /><br />
<?php $content = ob_get_clean(); ?>

<?php require_once ("Views/template.php");?>