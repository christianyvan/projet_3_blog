<!-- Vue qui affichera les erreurs -->
<?php ob_start()?>
 <div class="container">   
    <div class="card red">
        <div class="card-content white-text">
            <?php
                foreach($errors as $error){
                    echo '<h3>'.$error.'</h3><br/>'; 
               }
            ?>
        </div>
    </div>
</div>
<?php $content = ob_get_clean();?>                                  
<?php require 'template.php';?>


