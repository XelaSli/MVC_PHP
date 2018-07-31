<?php $title = "Create User"; ?>

<?php ob_start(); ?>
<form method="post" action="../AdminController.php?action=create">
    <label for="username">Username:   </label>
    <input type="text" id="username" name="username" placeholder="username" required>
    <br><br>
    <label for="email">Email:   </label>
    <input type="text" id="email" name="email" placeholder="email" required>
    <br><br>
    <label for="group">Group:   </label>
    <select id="group" name="group" required>
    <option selected>User</option>
    <option>Writer</option>
    <option>Administrator</option>
    </select>
    <br><br>
    <label for="password">Password:   </label>
    <input type="password" id="password" name="password" placeholder="password" required>
    <br><br>
    <label for="password_confirmation">Password confirmation:   </label>
    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="password_confirmation" required>
    <br><br>
    <button  type="submit" name="submit">Create</button>
</form>
<?php $content = ob_get_clean(); ?>

<?php require_once("../Views/template.php");?>