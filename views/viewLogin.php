<!-- Vue qui affiche le formulaire pour se logguer à partir du site a son compte
administrateur(modo ou admin)-->
<?php ob_start();?>
<div class="row">
    <div class=" col l4 m6 s12 offset-l4 offset-m3">
        <div class="div card-panel">
            <div class="row">
                <div class="col s6 offset-s3">
                    <img src="img/posts/admin.jpg" alt="Administrateur" width="100%">
                </div>
            </div>
            <h4 class="center-align">Se connecter</h4>
            <form  method="post" >
                <div class="row">
                    <div class="input-field col s12">
                        <input type="email" id="email"  name="email">
                        
                        <label for="email">Adresse email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="password" id="password"  name="password">
                        
                        <label for="password">Mot de passe</label>
                    </div>
                </div>
                <center>
                    <button type="submit" name="submit" class="btn light-blue">
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
