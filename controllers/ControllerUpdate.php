<?php
session_start();
/**
 * Description of ControllerUpdate
 *classe qui permet de modifier la valeur de seen d'un commentaire à 1 
 * Lorsqu'il a été lu et a raffraichir la page , le commentaire vu n'est plus 
 * affiché. L'affichage se fait dans la partie administration 
 * @author Christian
 */
class ControllerUpdate {
    use Controll;
    private $_commentManager;
       
    public function __construct($action)
    {
        if  (isset($action) && count($action) > 1)
        {
            $this->controllAction("L'action n'existe pas ou plus.");
            
        }  
        else 
        {
            $this->updateComment(); 
        }
    }
    
    /**
     * Fonction qui permet de modifier le statut vue (seen) d'un commentaire en 
     * le passant à seen=1, le commentaire est alors publié.
     * La vue Dashboard est actualisé, le commentaire est enlevé de la liste 
     * des commentaires non lu
     */
    private function updateComment()
    {
        $this->_commentManager = new CommentManager();
        
        if(isset($_GET['seen']))
        {
            $this->_commentManager->updateSeen($_GET['seen']);
            header("Location:index.php?action=dashboard");
        }
    }
}
