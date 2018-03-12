<?php

// On recupere l'URL de la page pour ensuite affecter class = "active" aux liens de nav
    $action = $_SERVER['REQUEST_URI'];
    $action = str_replace("/projet_3_blog/index.php?action=", "",$action);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Article de blog">
        <meta name="author" content="Christian Di Iorio">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/style.css"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
              
        <title>Blog | Dashboard</title>
    </head>

    <body class="background  blue lighten-5">
        <div class=" navbar-fixed">     
            <nav class="black container-fluid" id='dash'>
                <div class="nav-wrapper container">
                    <a href="index.php?action=home" class="brand-logo text-darken-1">Blog de Jean Forteroche</a>
                    <a href="#" data-activates="smartphone-menu" class="button-collapse"><i class="material-icons">menu</i></a>
        
                    <ul class="right hide-on-med-and-down">
                        
                        <li class="<?php echo($action=="home")?"active":"";?>">
                            <a href="index.php?action=home" class=" <?=($action=="home")?"background grey":"";?>"><i class="material-icons">home</i></a>
                        </li>
                        <li class="<?php echo($action=="disconnection")?"active":"";?>">
                            <a href="index.php?action=disconnection" class=" <?=($action=="disconnection")?"background grey":"";?>">Déconnexion</a>
                        </li>
                        
                        <li class="<?php echo($action=="settings")?"active":"";?>">
                            <a href="index.php?action=settings" <?= ($_SESSION['role']== 'modo')?'disabled':"" ?> class=" <?=($action=="settings")?"background grey":"";?>" ><i class="material-icons">settings</i></a>
                        </li>
                        <li class="<?php echo($action=="dashboard")?"active":"";?>">
                            <a href="index.php?action=dashboard" class=" <?=($action=="dashboard")?"background grey":"";?>" ><i class="material-icons">dashboard</i></a>
                        </li>                       
                        
                        <li class="<?php echo($action=="write")?"active":"";?>">
                            <a href="index.php?action=write" <?= ($_SESSION['role']== 'modo')?'disabled':"" ?> class=" <?=($action=="write")?"background grey":"";?>"><i class="material-icons">edit</i></a>
                        </li>
                        
                        <li class="<?php echo($action=="listpost")?"active":"";?>">
                            <a href="index.php?action=listpost" <?= ($_SESSION['role']== 'modo')?'disabled':"" ?> class=" <?=($action=="listpost")?"background grey":"";?>"><i class="material-icons">view_list</i></a>
                        </li>
                    </ul>
        
                    <ul class="side-nav" id="smartphone-menu">
                        <li class="<?php echo($action=="home")?"active":"";?>">
                            <a  href="index.php?action=home">Accueil</a>
                        </li>
                        <li class="<?php echo($action=="disconnection")?"active":"";?>">
                            <a href="index.php?action=disconnection">Déconnexion</a>
                        </li>
                        
                        <li class="<?php echo($action=="settings")?"active":"";?>">
                            <a href="index.php?action=settings">Paramètres</a>
                        </li>
                        <li class="<?php echo($action=="dashboard")?"active":"";?>">
                            <a href="index.php?action=dashboard">Tableau de bord</a>
                        </li>
                        
                        <li class="<?php echo($action=="write")?"active":"";?>">
                            <a href="index.php?action=write" >Publier un article</a>
                        </li>
                        
                        <li class="<?php echo($action=="listpost")?"active":"";?>">
                            <a href="index.php?action=listpost">Liste des articles</a>
                        </li>
                    </ul>
                </div>
            </nav>    
        </div>     
        <div>
            <p><?= $content ?></p>
        </div>    
    
    
    <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.js"></script>
      <script type="text/javascript" src="js/script.js"></script>
      <script type="text/javascript" src="js/settings.js"></script>
      <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
      <script>tinymce.init({ selector:'.textarea',
                            height:300,
                            
              });</script>
        
    </body>
</html>


