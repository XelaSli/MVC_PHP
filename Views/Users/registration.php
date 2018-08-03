<?php $title = "Registration"; ?>

<?php ob_start(); ?>
<form method="post" action="UsersController.php?action=register">
    <label for="username">Username:   </label>
    <input type="text" id="username" name="username" class="center-align" placeholder="username" required>
    <br><br>
    <label for="email">Email:   </label>
    <input type="text" id="email" name="email" class="center-align" placeholder="email" required>
    <br><br>
    <label for="password">Password:   </label>
    <input type="password" id="password" name="password" class="center-align" placeholder="password" required>
    <br><br>
    <label for="password_confirmation">Password confirmation:   </label>
    <input type="password" id="password_confirmation" name="password_confirmation" class="center-align" placeholder="password_confirmation" required>
    <br><br>
    <button  type="submit" class="waves-effect blue darken-1 btn" name="submit">Submit</button>
</form>
<?php $content = ob_get_clean(); ?>

<?php require_once ("Views/template.php");?>