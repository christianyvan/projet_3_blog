<?php ob_start();?>
<div  class="container black-text"  id="avion2">
    <h1 class="flow-text">Suivez mon nouveau roman</h1>
    <h1 class="flow-text btn-large background  blue lighten-1 white-text">Billet simple pour l'Alaska</h1>
</div>
<br/><br/>
<hr>
<div class="container">
    <h3 id="h31" class="left grey-text">Derniers chapitres publiés</h3>
</div>
<br/><br/>

<div class="container">
    <div class="row">
    
    <?php       
    foreach ($posts as $post): ?>
        <div class=" col l6 m6 s12">
            <div class="card">
                <div class="card-content">
                     <h5 class="grey-text text-darken-2"><?= $post->title();?></h5>
                    <h6 class="grey-text text-darken-2"><time>Le<?= date(" d/m/Y à H:i",strtotime($post->date()));?></time> par <?= $post->name(); ?></h6>
                </div>   
                
                <div class="card-image">
                    <img src="./img/posts/<?= $post->image();?>" class="activator" alt="<?= $post->title();?>"  height="200px" class="img-thumbnail img-responsive" class="activator"> 
                </div>
            
                <div class="card-content">
                    <div class="row s12 l6 m6">
			<span class="card-title activator grey-text offset-l1 col l3  ">LIRE</span>
			<p><a class="grey-text  offset-l1 col l3 center" href="index.php?action=post&id=<?= $post->id();?>">Commenter</a></p>
			<p><a class="grey-text offset-l1 col l3  center" href="index.php?action=blog">Sommaire</a></span>
                    </div>
		</div>  
            
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4"><?= $post->title();?><i class="material-icons right">close</i></span>
                <p><?= $post->content()?>...</p>
                </div>
            </div>
        </div>
<?php endforeach;?>
    </div><!-- end class row -->
</div>
<?php $content = ob_get_clean();?>
<?php require 'template.php';?>


