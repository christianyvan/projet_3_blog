<!-- Vue qui affiche les articles complet avec les commentaires associés 
et son image. Un formulaire pour ajouter un commentaire est également affiché -->
<?php ob_start(); ?>
<div class="parallax-container">
    <div class="parallax">
        <img src="img/posts/<?= $post->image();?>" alt="<?= $post->title();?>">
    </div>
</div>

<article class="container">
    <header>
        <h2 class="title_post"><?= $post->title();?></h2>
        <time>Le<?= date(" d/m/Y à H:i",strtotime($post->date()));?></time>
    </header>
    <p><?= nl2br(htmlspecialchars_decode($post->content()));?></p>
    <hr>
</article>

<?php

    if($comments != false){ ?>
    <div class="container"><h4 id="title_response">Commentaire sur <?= $post->title();?></h4></div>
        <?php foreach ($comments as $comment): ?>
            <div class="container">
                <p><?= $comment->name();?> le <?= date("d/m/Y",strtotime($comment->date()));?> a dit :</p><br>
                <p><?= nl2br(htmlspecialchars_decode($comment->content()));?></p><br>
                <hr>
            </div>
        <?php endforeach; ?>
    <?php 
    }else echo '<div class="container"><h6>Pas de commentaire pour cet article... Soyez le premier</h6></div>';
    ?>
 
<?php $content = ob_get_clean();?>
<?php require 'template.php'; 
?> 
<div class="container blue-text">
    <h5>Laisser votre commentaire:</h5>
</div>
   
<form method="post" action="index.php?action=comment&id=<?= $post->id();?>" class="container">
    <div class="row">
        <div class="input-field col s12 m6">
            <label for="author">Nom</label>
            <input id="author" name="name" type="text" required="required" >
        </div>
        
        <div class="input-field col s12 m6">
            <label for="email">Adresse email</label>
            <input type="text" id="email" name="email" >
        </div>    
        
        <div class="input-field col s12 m12">
                <label for="postComment">Votre commentaire</label> 
                <textarea id="postComment" name="postComment" class="materialize-textarea" required="required"></textarea>
        </div>
            
        <div class="col s12">
                <button type="submit" name="submit" class="btn">commenter</button>
        </div>
    </div>
</form>

