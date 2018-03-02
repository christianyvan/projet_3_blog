<!-- Vue qui affiche la page du tableau de bord de la partie administration -->
<?php ob_start();?>
<div class="container">
    <h2 id="h22">Tableau de bord</h2>
    <br/><br/>    
<div class="row">
    
    
    <?php foreach($tables as $table_name => $table): ?>
    <div class=" col l4 m6 s12 ">
        <div class="card">
            <div class="card-content <?= $colors[$table]?> ">
                <center>
                    <span class="card-title white-text "><?= $table_name ?>
                    </span>
                </center>
                <center>
                    <h4 class="white-text"><?= $nbrInTable[$table]?></h4>
                </center>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>
  </div>
<div class="container">
    <br/>
    <h4 id="h43">Commentaires non lus</h4>
    <br/><br/>
    
<table>
    <div class="row">
        <div class="col s12">
            <div class="col s2 blue">Nom articles</div>
            <div class="col s8 green">Commentaires</div>
            <div class="col s2 grey">Actions</div> 
        </div>   
    </div>
    <tbody>
    <?php
    if(!empty($comments)){
        foreach ($comments as $comment){
        ?>
    <div class="row">
        <div class="col s12">
            <div class="col s2"><?= $comment->title();?></div> 
            <div class="col s8"><?= $comment->content();?></div>
            <div class="col s2"><a href="index.php?action=delete&del=<?= $comment->id();?>" id="<?= $comment->id();?>" <?= ($modo['modo']== 'modo')?"disabled":""?> class="btn-floating btn-small red delete_comment right"><i class="material-icons">delete</i></a>
                <a href="index.php?action=update&seen=<?= $comment->id();?>" id="<?= $comment->id();?>" <?= ($modo['modo']== 'modo')?"disabled":""?> class="btn-floating btn-small green see_comment "><i class="material-icons">done</i></a>
            </div>
        </div >       
    </div>        
        
        <?php
        }
    }else{
        ?>
            <tr>
                <td></td>
                <td><center>Aucun commentaire à valider</center></td>
            </tr>
            <?php } ?>  
               
    </tbody>
</table>
</div>
<?php $content = ob_get_clean();?>

<?php require 'templateDashboard.php';?>
