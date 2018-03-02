<?php ob_start(); ?>
<!-- vue qui affiche un article complet dans la partie admin du site-->
<!-- ici on peut modifier l'article -->
<div class="container-fluid">  
    <div class="parallax-container">
        <div class="parallax">
            <img src="img/posts/<?= $post->image();?>" alt="<?= $post->title();?>">
        </div>
    </div>
</div> 


<form method="post" action="index.php?action=postedit&id=<?= $post->id();?>">
    <div class="container">   
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="title" id='title' value="<?= $post->title();?>">
                <label for="title">Titre de l'article</label>
            </div>
            <div class="input-field col s12">
                <textarea name="content" class="textarea" ><?= $post->content();?></textarea>
                <label for="content">Contenu de l'article</label>
            </div>
        
            <div class="col s6">
                <p>Public</p>
                <div class="switch">
                    <label >
                        Non
                        <input type="checkbox" name="public"<?php echo ($post->posted()== "1")? "checked": ""?>>
                        <span class="lever grey"></span>
                        Oui
                    </label>
                </div>
            </div>
        </div>
        <div class="col s6 right-align">
            <div class="row">
                <button type="submit" class="btn background grey" name="publish">Modifier l'article</button>
                <a href="index.php?action=post&delete=<?= $post->id();?>" class="btn background grey">Supprimer l'article</a>
            </div>
        </div>
    </div>
</form>

<?php $content = ob_get_clean();?>
<?php require 'templateDashboard.php'; // template.php récupère la valeur $content qui contient le post avec ses commentaires

    
