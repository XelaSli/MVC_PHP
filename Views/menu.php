<div class="row">
    <nav class="blue darken-4 row">
        <ul id="nav-mobile" class="center">
            <li class="col s4"><a href="../Controllers/UsersController.php?action=profile">Profile</a></li>
<<<<<<< HEAD
            <?php if ($_SESSION["group"] != "Admin"){ ?>
            <li class="col s4"><a class="hide" href="">Admin</a></li>
            <?php } else {?>
            <li class="col s4"><a href="../Controllers/UsersController.php?action=admin">Admin</a></li>
            <?php } ?>
            <li class="col s4"><a href="../Controllers/UsersController.php?action=logout">Log out</a></li>
=======
            <li class="col s4"><a href="../Controllers/UsersController.php?action=logout">Log out</a></li>
            <?php if($_SESSION['group']=='Admin'){?>
            <li class="col s4"><a href="../Controllers/UsersController.php?action=admin">Admin</a></li><?php } ?>
>>>>>>> fdfa29770b3ea2e4102d11ee38d6fce3134a2363
        </ul>
    </nav>
</div>