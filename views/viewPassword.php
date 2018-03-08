<!-- Vue qui affiche un formulaire de connection après avoir répondu
à l'email de confirmation d'ouverture de compte -->
<?php ob_start();?>
<div class="row">
    <div class=" col l4 m6 s12 offset-l4 offset-m3">
        <div class="div card-panel">
            <div class="row">
                <div class="col s6 offset-s3">
                    <img src="img/posts/password.png" alt="Moderateur" width="100%">
                </div>
            </div>
            <h4 class="center-align">Se connecter</h4>
            <form  method="post" action="index.php?action=password">
                <div class="row">
                    <div class="input-field col s12">
                        <input type="password" id="password"  name="password">
                        
                        <label for="password">Mot de passe</label>
                    </div>
                
                    <div class="input-field col s12">
                        <input type="password" id="password_again"  name="password_again">
                        
                        <label for="password_again">Confirmer le mot de passe</label>
                    </div>
                </div>
                <center>
                    <button type="submit" name="pwd" class="btn light-blue">
                        <i class="material-icons left">perm_identity</i>
                        Se connecter
                    </button>
                    <br/><br/>
                   
                </center>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean();?>
<?php require 'template.php';?>

