<?php $title = "Log in"; ?>

<?php ob_start(); ?>
<form method="post" id="noMenu">
<label for="username">Username: </label>
<input type="text" id="username" name="username" required /><br /><br />

<label for="password">Password: </label>
<input type="password" id="password" name="password" required /><br /><br />

<input type="submit" value="Log in" />
</form>
<?php $content = ob_get_clean(); ?>

<?php require_once("template.php");
?>