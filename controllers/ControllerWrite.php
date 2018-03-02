<?php
require_once ('views/View.php');

/**
 * Description of ControllerWrite
 * Affiche un formulaire pour pouvoir écrire un article , on pourra ensuite
 * le publier en le mettant public ou privé 
 * @author Christian
 */

class ControllerWrite {
    private $_view;
        
    public function __construct($action)
    {
        if (isset($action) && count($action) > 1)
        {
            throw new Exception('Page introuvable');
        }   else 
            {
                $this->affiche(); 
            }
    }
    
    /**
     * Fonction affiche qui génère la view viewWrite dans laquelle on peut 
     * écrire un article.
     * La vue est généré que si l'on est admin.
     */
    private function affiche()
    {
        if($_SESSION['role'] == 'admin')
        {
            $this->_view = new View('Write');
            $this->_view->generate(array());
        }
        else 
        {
            header("location:index.php?action=dashboard");
        }
    }
}

