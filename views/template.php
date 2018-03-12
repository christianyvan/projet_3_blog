<?php
      
// On recupere l'URL de la page pour ensuite affecter class = "active" aux liens de nav
$action = $_SERVER['REQUEST_URI'];
$action = str_replace("/index.php?action=", "",$action);
 ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Article de blog">
        <meta name="author" content="Christian Di Iorio">
        <!--Import Google Icon Font-->
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>  
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

         <link type="text/css" rel="stylesheet" href="css/style.css"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script type="text/javascript" src="js/script.js"
        
        
        
        <title>Mon blog</title>
    </head>

    <body class="background blue lighten-5">
        <div class=" navbar-fixed">     
            <nav class="black container-fluid">
                <div class="wrapper container">
                    <a href="index.php?action=home" class="brand-logo">Blog de Jean Forteroche</a>
                    <a href="#" data-activates="smartphone-menu" class="button-collapse"><i class="material-icons">menu</i></a>
        
                    <ul class="right hide-on-med-and-down" >
                        <li>
                            <a class="<?=($action=="home")?"background grey":"";?>" href="index.php?action=home">Accueil</a>
                        </li>
                        
                        <li >
                            <a class="<?=($action=="blog")?"background grey":"";?>" href="index.php?action=blog">Blog</a>
                        </li>
                
                        <li>
                            <a  class="<?=($action=="login")?"background grey":"";?>" href="index.php?action=login">Admin</a>
                        </li>
                        
                        <li>
                            <a  class="<?=($action=="inscription")?"background grey":"";?>" href="index.php?action=inscription">Inscription</a>
                        </li>
                    </ul>
        
                    <ul class="side-nav" id="smartphone-menu">
                        <li class="<?php echo($action=="home")?"active":"";?>">
                            <a  href="index.php?action=home">Accueil</a>
                        </li>
                        
                        <li class="<?php echo($action=="blog")?"active":"";?>">
                            <a href="index.php?action=blog">Sommaire</a>
                        </li>
                
                        <li class="<?php echo($action=="login")?"active":"";?>">
                            <a  href="index.php?action=login">Tableau de bord</a>
                        </li>
                        
                        <li class="<?php echo($action=="inscription")?"active":"";?>">
                            <a  href="index.php?action=inscription">Inscription</a>
                        </li>
                    </ul>
                </div>
            </nav>    
        </div>     
        
        <div class="container-fluid" style="padding-top:20px">
            <div class="card-content background">
                <div class="card-title container background ">
                    <br/>
                    <h3 id="h11"><a  href="<?= URL ?>">Bienvenu sur le blog de Jean Forteroche</a></h3>
                </div>
                <p><?= $content ?></p>
            </div>
        </div><!-- /.container -->
        
    
    <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>
      <script type="text/javascript" src="js/script.js"></script>
    </body>
</html>






















