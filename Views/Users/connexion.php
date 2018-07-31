<?php $title = "Log in"; ?>

<?php ob_start(); ?>
<form method="post">
<label for="username">Username: </label>
<input type="text" id="username" name="username" required /><br />

<label for="password">Password: </label>
<input type="password" id="password" name="password" required /><br />

<input type="submit" value="Log in" />
</form>
<?php $content = ob_get_clean(); ?>

<?php require_once("template.php");
?>