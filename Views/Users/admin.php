<?php $title = "Admin user"; ?>

<?php ob_start(); 


?>
<h1>Admin</h1>
<form method="get" action="AdminController.php">
<input type="hidden" value="create_user" id="action" name="action" />
<input type="submit" value="Add a new user" />
</form>
<table>
<tr>
    <th>Username</th>
    <th>Email</th>
    <th>Group</th>
    <th>Banned</th>
    <th>Date of creation</th>
    <th>Last modification</th>
    <th>Action</th>
  </tr>
  <?php
  foreach($userList as $values){
  echo "<tr><td>";
  echo $values['username']."</td><td>";
  echo $values['email']."</td><td>";
  echo $values['group']."</td><td>";
  echo $values['banned']."</td><td>";
  echo $values['creation_date']."</td><td>";
  echo $values['edition_date']."</td>";
  ?>
  <td><a href="UsersController.php?action=edit_user&id=<?php echo $values['id']?>">Edit</a></td>
  <td><a href="UsersController.php?action=delete_user&id=<?php echo $values['id']?>">Delete</a></td>
  </tr><?php } ?>
</table>
<button  type="button" onclick="location.href='UsersController.php'">Back to Index</button>
<?php $content = ob_get_clean(); ?>

<?php require_once("../Views/template.php");
?>