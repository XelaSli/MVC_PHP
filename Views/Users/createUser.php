<?php $title = "Create User"; ?>

<?php ob_start(); ?>
<form method="post" action="AdminController.php?action=create_user">
    <label for="username">Username:   </label>
    <input type="text" id="username" name="username" placeholder="username" required>
    <br><br>
    <label for="email">Email:   </label>
    <input type="text" id="email" name="email" placeholder="email" required>
    <br><br>
    <label for="group">Group:   </label>
    <select id="group" name="group" required>
    <option  value= "User" selected>User</option>
    <option value="Writer">Writer</option>
    <option value ="Admin">Admin</option>
    </select>
    <br><br>
    <label for="password">Password:   </label>
    <input type="password" id="password" name="password" placeholder="password" required>
    <br><br>
    <label for="password_confirmation">Password confirmation:   </label>
    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="password_confirmation" required>
    <br><br>
    <button  type="submit" class="waves-effect blue darken-1 btn" name="submit">Create</button>
</form><br>
<button  type="button" class="waves-effect blue darken-1 btn" onclick="location.href='UsersController.php?action=admin'">Back to Admin</button>
<?php $content = ob_get_clean(); ?>

<?php require_once("Views/template.php");?>