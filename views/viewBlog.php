<!-- Vue qui affiche tout les posts -->
<?php ob_start()?>
<div  class="container black-text"  id="avion1">
            <h1 class="flow-text">Suivez mon nouveau roman</h1>
            <h1 class="flow-text btn-large white-text">Billet simple pour l'Alaska</h1>
</div>
<div class="container"> 
 <?php       
foreach ($posts as $post): ?>
<br/> 
    <div class="container col s12">
            <h4 class="black-text text-darken-2"><?= $post->title();?></h4>
    </div>        
    <div class="col s12">
        <?php $content = nl2br(htmlspecialchars_decode($post->content()));?>
        <p><?= substr($content,0,2200);?>....</p>
    </div>
    <br/>
    <div class="col s12 m6 l4">
        <img src="img/posts/<?= $post->image();?>" class="materialboxed responsive-img" alt="<?= $post->title();?>"/>
        <br>
        <a class="btn grey " href="index.php?action=post&id=<?= $post->id();?>">Articles complet</a>
    </div>
    <br/>
    <hr>

<?php endforeach ?>
</div>
<?php $content=ob_get_clean()?>
<?php require 'template.php';?>
