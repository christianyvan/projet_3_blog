<!-- vue qui affiche le formulaire qui permet la création d'un post 
et l'ajout d'une image -->
<?php ob_start();?>
<div class="container">
<h2>Poster un article</h2>

<form method="POST" action="index.php?action=publish" enctype="multipart/form-data">
    <div class="row">
        <div class="input-field col s12 ">
            <input type="text" name="name" id="nom"/>
            <label for="title">Nom de l'auteur</label>
        </div>
        
        <div class="input-field col s12 ">
            <input type="text" name="title" id="title"/>
            <label for="title">Titre de l'article</label>
        </div>
        
        <div class='input-field col s12'>
            <h4 >Créer l'article</h4>
            <textarea name="content" id='content' class="textarea"></textarea>
            
        </div>
        
        <div class="col s12">
            <div class="input-field file-field">
                <div class="btn grey col s3">
                   <span>Ajouter une image</span>
                   <input type="file" name="image"  class="col s12 "><i class="material-icons">details</i>
                </div>
                <input type="text" class="file-path col s9" readonly>
            </div>
        </div>
        
        <div class="col s6">
            <p>Public</p>
            <div class="switch">
                <label >
                    Non
                    <input type="checkbox" name="public"/>
                    <span class="lever"></span>
                    Oui
                </label>
            </div>
        </div>
        <div class="col s6 right-align">
            <br><br>
            <button class="btn grey" type="submit" name="publish">Publier</button>
        </div>
    </div>

</form>
</div>
<?php $content = ob_get_clean();?>
<?php require 'templateDashboard.php';?>        
        

