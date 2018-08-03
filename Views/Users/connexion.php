<?php $title = "Log in"; ?>

<?php ob_start(); ?>
<form method="post">
<label for="username_connect">Username: </label>
<input type="text" id="username_connect" class="center-align" name="username_connect" required /><br /><br />

<label for="password_connect">Password: </label>
<input type="password" id="password_connect" class="center-align" name="password_connect" required /><br /><br />

<input type="submit" class="waves-effect blue darken-1 btn" value="Log in" />
</form>
<p><a href="UsersController.php?action=register">Not registered yet?</a></p>
<?php $content = ob_get_clean(); ?>

<?php require_once("Views/template.php");
?>