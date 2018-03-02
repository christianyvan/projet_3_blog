<!-- Vue qui affiche un extrait de tout les articles dans la partie admin
du site -->
<!-- les articles avec un cadenas ne sont pas postés -->
<!-- article complet renvoie vers la viewPostadmin ou on pourra lire ou modifier
l'article--> <?php ob_start()?>
<div class="container">
<h2>Listing des articles</h2>
</div>
<hr>
<?php foreach ($posts as $post): ?>
<div class="row ">    
    <div class=" container">      
        <div class="container col s6">
            <h4 >
                <?= $post->title();?>
                <?php echo($post->posted()== 0)? "<i class='material-icons'>lock</i>" :"" ?>
            </h4>
        </div>
                
        <div class="col s6">
            <?= substr((htmlspecialchars_decode($post->content())),0,1800)?>...
        </div>
               
        <div class="col s6">
            <img src="img/posts/<?= $post->image();?>" class="materialboxed responsive-img" alt="<?= $post->title();?>"/>
            <br><br>
            <a class="btn grey " href="index.php?action=postadmin&id=<?= $post->id();?>">Voir-Modifier</a>
        </div>
    </div>
</div><!-- end class row -->
<?php endforeach ?>
<?php $content=ob_get_clean()?>
<?php require 'templateDashboard.php';?>
