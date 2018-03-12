<?php

/**
 * Description of ControllerDelete
 * Classe qui permet la suppression d'un commentaire à partir du 
 * tableau de bord.
 * @author Christian
 */
class ControllerDelete {
    use Controll;
    private $_commentManager;
      
    public function __construct($action)
    {
        if (isset($action) && count($action) > 1) 
        {
            $this->controllAction("L'action n'existe pas ou plus");
        }   else 
            {
                $this->deleteComment(); 
            }
    }
    
    /**
     * Fonction qui supprime le commentaire d'un post en cliquant sur l'icone 
     * corbeille de la page dashboard, la page est raffraichit pour afficher les
     * changements.
     */
    private function deleteComment()
    {
        $this->_commentManager = new CommentManager();
        if(isset($_GET['del']))
        {
            $this->_commentManager->delComment($_GET['del']);
            header("Location:index.php?action=dashboard");
        }
    }
}
