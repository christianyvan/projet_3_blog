<?php ob_start();?>

<hr>
<br/><br/>

<div class="container">
    <h3 id="h31">Derniers chapitres publiés</h3>
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
                    <div class="row">
                    <span class="col l2 card-title activator right grey-text text-darken-4 "><i class="material-icons">more_vert</i></span>
                
                        <div class="col l5"><a href="index.php?action=post&id=<?= $post->id();?>">Article complet</a></div>
                        <div class="col l5"><a href="index.php?action=blog">Voir plus</a></div>
                    </div>
                </div>
            
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4"><?= $post->title();?><i class="material-icons right">close</i></span>
                        <?php $content =$post->content();
                        $content = htmlspecialchars_decode($content);
                        $content = substr($content,0,1500);
                        ?>
                <p><?= $content ?>...</p>
                </div>
            </div>
        </div>
<?php endforeach;?>
    </div><!-- end class row -->
</div>
<?php $content = ob_get_clean();?>
<?php require 'template.php';?>


