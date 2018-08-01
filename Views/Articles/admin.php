
<?php 

$title = "Admin article"; ?>

<?php ob_start(); ?>
<table>
<tr>
    <th>Title</th>
    <th>Content</th>
    <th>Author</th>
    <th>Date of creation</th>
    <th>Last modification</th>
    <th>Action</th>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
<?php $content = ob_get_clean(); ?>

<?php require_once("../Views/template.php");
?>