<!-- Vue qui affiche dans la partie administration les modos du site-->
<?php ob_start();?>
<div class="container">
    <h2 id="h21">Inscription</h2>
    <br/><br/>
</div>
<div class="container">
    <div class="row">
        <div class="container">
            <h6 id="h42">Devenez modo en recevant le code unique vous permettant de créer votre mot de passe</h6>
            <br/>
        </div>
        <form method="post" action="index.php?action=inscription" >
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="name" id="name" required="required"/>
                    <label for="name" >Nom</label>
                </div>
                
                <div class="input-field col s12">
                    <input type="email" name="email" id="email" required="required"/>
                    <label for="email" >Adresse email</label>
                </div>
                
                <div class="input-field col s12">
                    <input type="email" name="email_again" id="email_again" required="required"/>
                    <label for="email_again" >Confirmer adresse email</label>
                </div>
                
                <div class="col s6">
                    <button type="submit" name="submit" class="btn grey">S'inscrire</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $content = ob_get_clean();?>
<?php require 'template.php';?>


