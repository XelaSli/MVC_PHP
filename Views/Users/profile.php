<?php $title = "Profile"; ?>

<?php ob_start(); ?>
<header><?php include_once('menu.php'); ?></header>
<form method="get">
    <label for="username">Username:   </label>
    <input type="text" id="username" name="username" placeholder="username" readonly>
    <br><br>
    <label for="email">Email:   </label>
    <input type="email" id="email" name="email" placeholder="email" readonly>
</form>
<?php $content = ob_get_clean(); ?>

<?php require_once("template.php");
?>