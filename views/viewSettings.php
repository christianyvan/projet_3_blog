<!-- Vue qui affiche dans la partie administration les modos du site-->
<?php ob_start();?>
<div class="container">
    <h2 id="h21">Paramètres</h2>
    <br/><br/>
</div>
<div class="container">
    <div class="row">
        <div class="col m6 s12 container" id="mod">
            <div class="container ">
                <h4 id="h41">Modérateurs</h4>
                <br/>
            </div>
            <table >
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Validé</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($modos as $modo)
                {
                ?>  
                    <tr>
                        <td><?=$modo->name();?></td>
                        <td><?= $modo->email();?></td>
                        <td><?= $modo->role(); ?></td>
                        <td><i class="material-icons"><?php echo(!empty($modo->password()))? "verified_user" : "av_timer";?></i></td>
                    </tr>
                <?php    
                }
                ?>
                </tbody>
            </table>
        
        </div>
        <div class="col m6 s12">
            <div class="container">
                <h4 id="h42">Ajouter un modo</h4>
                <br/>
            </div>
                <form method="post" >
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
                
                        <div class="input-field col s12">
                            <select name="role" id="role">
                                <option value="modo" selected="selected">Modérateur</option>
                                <option value="admin">Administrateur</option>
                            </select>
                            <label for="role" >Rôle</label>
                        </div>
                        <div class="col s6">
                            <button type="submit" name="submit" class="btn grey">Ajouter</button>
                        </div>
                        <div class="col s6">
                            <button type="submit" name="submit2" class="btn grey right">Supprimer</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
<?php $content = ob_get_clean();?>
<?php require 'templateDashboard.php';?>

