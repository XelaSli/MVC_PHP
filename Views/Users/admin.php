<?php $title = "Admin user"; ?>

<?php ob_start(); 


?>
<h2>Admin</h2>
<form method="get" action="./create_user">
<input type="submit" value="Add a new user" class="waves-effect blue darken-1 btn"/>
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
  <td><a href="edit_user&amp;id=<?php echo $values['id']?>"><i class="material-icons">edit</i></a>
  <a href="delete_user&amp;id=<?php echo $values['id']?>"><i class="material-icons">delete_forever</i></a></td>
  </tr><?php } ?>
</table><br><br>
<button  type="button" onclick="location.href='.'" class="waves-effect blue darken-1 btn">Back to Index</button>
<?php $content = ob_get_clean(); ?>

<?php require_once("Views/template.php");
?>