<?php


/**
 * Description of ControllerListpost
 * Classe qui récupère la liste de tout les posts (poster ou pas) dans la 
 * partie "liste des posts" de la partie administration du site.
 * @author Christian
 */
// 
class ControllerListpost 
{
    use Controll;
    private $_postManager;
    private $_view;
    
    public function __construct($action)
    {
        if (isset($action) && count($action) > 1)
        {
            $this->controllAction("L'action n'existe pas ou plus.");
        } 
        
        if(!isset($_SESSION['role']))
        {
            $this->controllAction("    Désolé, accès non autorisé.");
        }
        
        if(isset($_SESSION['role']))
        {
            if($_SESSION['role']=='admin')
            {
                $this->posts(); 
            }
            else
            {
               $this->controllAction("    Désolé, accès non autorisé.");
            }
        }
    }
    
    
    /**
     * Fonction qui récupère tous les posts de la tables posts dans la parti
     * administration du site,et les envois en paramètre à la vue viewListpost
     * qui va les lister,un bouton permettra de les voir et/ou les modifier.
     * Seul l'administrateur pourra accéder à la liste.
     */
    private function Posts()
    {
        $this->_postManager = new PostManager();
       
        if($_SESSION['role']== 'admin')
        {   
            
            $posts = $this->_postManager->getAllPosts();
                       
            $errors = [];
            if($posts == FALSE)
            {
                $errors = "Pas de post a afficher pour le moment";
            }
                
            if(!empty($errors))
            {
                $this->_view = new View('Error');
                $this->_view->generate(array('errors' => $errors));
            } 
            else
            {
                $this->_view = new View('Listpost');
                $this->_view->generate(array('posts' => $posts));
            }
        } 
        else
        {
            header("Location:index.php?action=dashboard");
        }
    }    
}
