<?php $title = "Profile"; ?>

<?php ob_start(); ?>
<header><?php include_once('Views/menu.php'); ?></header>
<form>
    <label for="username">Username:   </label>
    <input type="text" id="username" name="username" value="<?= $data["username"] ?>" readonly>
    <br><br>
    <label for="email">Email:   </label>
    <input type="email" id="email" name="email" value="<?= $data["email"] ?>" readonly>
</form>
<p><a href="index.php?action=delete&amp;id=<?= $data["id"] ?>"><i class="material-icons">delete_forever</i></a></p>
<button  type="button" onclick="location.href='.'" class="waves-effect blue darken-1 btn">Back to Index</button><br>
<?php $content = ob_get_clean(); ?>

<?php require_once("Views/template.php");
?>