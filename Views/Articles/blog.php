<?php $title = "Blog"; ?>

<?php ob_start(); ?>
<header><?php include_once('../Views/menu.php'); ?></header>
<p>Test<p>
<?php $content = ob_get_clean(); ?>

<?php require_once("../Views/template.php");