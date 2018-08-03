<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="js/materialize.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script>
         document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var options = {};
            var instances = M.FormSelect.init(elems, options);
        });
    </script>
    <script>
        /* Fix bug where materializecss checkboxes only render if before labels. */
        $.each($(':checkbox'), function(k, v) {
            var label = $(this).closest('label');
            $(this).insertBefore(label);
        });
    </script>
    <title><?=$title?></title>
</head>
<body>
<header>
    <div class="blue darken-4 center-align">
        <div><a href="index.php"><img src="img/fakebook1.jpg" class="responsive-img" width="30%" height="30%"></a></div>
    </div>
</header>

<div class="center-align">
    <div class="container">
        <?=$content?>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br>
<footer class="page-footer grey darken-1">
    <div class="container" height="50px">
        <div class="row">
            <div class="col s12 ">
                <div class="center-align">
                    <h5 class="white-text">Contact</h5>
                </div>
                <div class="center-align">
                    <a href="http://www.facebook.com/The.Fakebook.Real/" target="_blank" ><img src="img/fb.png" width="50px" heigth="50px"></a>
                    <a href="http://images.toucharger.com/img/graphiques/gifs-animes/cinema/autres/exorcist.73210.gif" target="_blank" ><img src="img/twitter.png" width="50px" heigth="50px"></a>
                    <a href="https://www.wnba.thedailydunk.co/wp-content/uploads/2018/07/Simpson.jpg" target="_blank" ><img src="img/insta.png" width="50px" heigth="50px"></a>
                </div>
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