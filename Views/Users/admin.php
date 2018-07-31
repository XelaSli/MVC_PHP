<?php $title = "Admin user"; ?>

<?php ob_start(); ?>
<table>
<tr>
    <th>Username</th>
    <th>Email</th>
    <th>Group</th>
    <th>Date of creation</th>
    <th>Last modification</th>
    <th>Action</th>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
<?php $content = ob_get_clean(); ?>

<?php require_once("template.php");
?>