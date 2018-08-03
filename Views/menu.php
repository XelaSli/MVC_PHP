<div class="row">
    <nav class="light-blue darken-4 row">
        <ul id="nav-mobile" class="center">
            <li class="col s4"><a href="profile">Profile</a></li>
            <?php if ($_SESSION["group"] != "Admin"){ ?>
            <li class="col s4"><a class="hide" href="">Admin</a></li>
            <?php } else {?>
            <li class="col s4"><a href="admin">Admin</a></li>
            <?php } ?>
            <li class="col s4"><a href="logout">Log out</a></li>
        </ul>
    </nav>
</div>