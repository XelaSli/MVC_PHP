<?php $title = "Edit User"; ?>

<?php ob_start();?>
<form method="post" action="AdminController.php?action=edit_user">
<label for="username">Username:   </label>
<input type="text" id="username" name="username" value="<?php echo $user['username'] ?>" placeholder="username" required>
<br><br>
<label for="email">Email:   </label>
<input type="text" id="email" name="email" value="<?php echo $user['email'] ?>" placeholder="email" required>
<br><br>
<label for="group">Group:   </label>
<select id="group" name="group" value="<?php echo $user['group']?> ">
<option>User</option>
<option>Writer</option>
<option>Admin</option>
</select>
<br><br><?php
if ($user["banned"]=='yes') {
                    echo "Banned:   <input type='checkbox' name='banned' checked>";
                } else {
                    echo "Banned:   <input type='checkbox' name='banned' unchecked>";
                }

                ?>
<br><br>
<button  type="submit" name="submit">Modify</button>
</form>
<button  type="button" onclick="location.href='UsersController.php?action=admin'">Back to Admin</button>
<?php $content = ob_get_clean(); ?>

<?php require_once("../Views/template.php");?>