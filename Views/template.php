<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/materialize.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script>
         document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var options = {};
            var instances = M.FormSelect.init(elems, options);
        });
    </script>
    <title><?=$title?></title>
</head>
<body>
<header>
    <div class="blue darken-4 center-align">
        <div><a href="../Controllers/UsersController.php"><img src="../img/fakebook.jpg" class="responsive-img" width="20%" height="20%"></a></div>
    </div>
</header>
<br><br>
<div class="center-align">
    <div class="container">
        <?=$content?>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br>
<footer class="page-footer blue darken-3">
    <div class="container" height="50px">
        <div class="row">
            <div class="col s12 ">
                <div class="center-align">
                    <h5 class="white-text">Contact</h5>
                </div>
                <ul class="center-align">
                    <li><a href="" class="white-text text-lighten-3" href="#!">Instagram</a></li>
                    <li><a href="" class="white-text text-lighten-3" href="#!">Twitter</a></li>
                    <li><a href="mailto:customer-service@gmail.com" class="white-text text-lighten-3" href="#!">Contact us</a></li>  
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container center-align">
        © 2018 Fakebook Inc. ALL RIGHTS RESERVED 
        </div>
    </div>
</footer>
</body>
</html>