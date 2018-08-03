<?php $title = "Manage category"; ?>

<?php ob_start();?>
<p><a href="UsersController.php" class="waves-effect blue darken-1 btn">Back</a></p>

<h2>Category</h2>

<table>
<tr>
    <th>Name</th>
    <th class="right-align">Action</th>
  </tr>
  <?php
  foreach($cats as $values){
  echo "<tr><td class='name' >";
  echo $values['category']."</td><td>";
  ?>
  <td><a class='edit' href="ArticlesController.php?action=edit_category&amp;id=<?php echo $values['id']?>"><i class="material-icons">edit</i></a>
  <a href="ArticlesController.php?action=delete_category&amp;id=<?php echo $values['id']?>"><i class="material-icons">delete</i></a></td>
  </tr>
  <?php } ?>
</table><br /><br />
<form method="post" action="ArticlesController.php">
<label for="title_category"><strong>Title:</strong> </label>
<input type="text" id="title_category" name="title_category" required />
<input class="waves-effect blue darken-1 btn" type="submit" value="Add Category" />
</form>
<h2>Tag</h2>

<table>
<tr>
    <th>Name</th>
    <th class="right-align">Action</th>
  </tr>
  <?php
  foreach($tags as $values){
  echo "<tr><td>";
  echo $values['tag']."</td><td>";
  ?>
  <td><a href="ArticlesController.php?action=delete_tag&amp;id=<?php echo $values['id']?>"><i class="material-icons">delete</i></a></td>
  </tr><?php } ?>
</table><br /><br />
<form method="post" action="ArticlesController.php">
<label for="title_taf"><strong>Title:</strong> </label>
<input type="text" id="title_tag" name="title_tag" required />
<input class="waves-effect blue darken-1 btn" type="submit" value="Add Tag" />
</form><br /><br />
<?php $content = ob_get_clean();?>

<?php require_once "../Views/template.php";