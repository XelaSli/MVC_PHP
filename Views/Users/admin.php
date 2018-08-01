<?php $title = "Admin user"; ?>

<?php ob_start(); 
//var_dump($userList);
foreach($userList as $values)
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
    <th>Date of creation</th>
    <th>Last modification</th>
    <th>Action</th>
  </tr>
  <?php
  echo "<tr><td>";
  echo $values['username']."</td><td>";
  echo $values['email']."</td><td>";
  echo $values['group']."</td><td>";
  echo $values['creation_date']."</td><td>";
  echo $values['edition_date']."</td>";
  ?>
  <td><a href="UsersController.php?action=edit">Edit</a></td>
  <td><a href="">Delete</a></td>
  </tr>
</table>
<?php $content = ob_get_clean(); ?>

<?php require_once("../Views/template.php");
?>