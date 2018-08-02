<?php $title = "Add an article"; ?>


<?php ob_start();?>
<h1>Add an article</h1>
<form method="post" action="ArticlesController.php">
<label for="title_article">Title: </label>
<input type="text" id="title_article" name="title_article" required /><br /><br />

<label for="content_article">Content: </label>
<textarea id="content_article" name="content_article" required></textarea><br /><br />

<label for="category_select">Category: </label>
<div class="input-field">
    <select id="category_select" name="category_select" required >
        <option value=""></option>
        <?php
        foreach ($cats as $cat){
            echo "<option value='" . $cat["category"] . "'>" . $cat["category"] . "</option>";
        }
        ?>          
    </select>
</div>
<br /><br />

<label>Tags: </label>
<div class="input-field">
    <?php
    foreach($tags as $tag){
        echo "<p><input type='checkbox' id='checkboxid' class='filled-in' name='" . $tag["tag"] . "' value='" . $tag["tag"] . "' />";
        echo "<label for='checkboxid' /> " . $tag["tag"] . "</label></p>";
    }
    ?>
</div>
<br /><br />
<input type="hidden" value="<?= $userController::getUser()->getUserId($_SESSION["username"]); ?>" name="author" id="author" />
<input class="waves-effect blue darken-1 btn" type="submit" value="Add" />
</form>
<p><a href="UsersController.php" class="waves-effect blue darken-1 btn">Back</a></p>
<?php $content = ob_get_clean();?>

<?php require_once "../Views/template.php";