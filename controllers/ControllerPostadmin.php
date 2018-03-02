<?php
require_once ('views/View.php');
/**
 * Description of ControllerPostadmin
 * Classe qui retourne un post dans la vue viewPostadmin après action lispost.
 * @author Christian
 */

class ControllerPostadmin 
{
    protected $_postManager;
    protected $_view;
    
    public function __construct($action)
    {
        if  (isset($action) && count($action) > 1)
        {
            throw new Exception('Page introuvable');
        }   else 
            {
                    if(isset($_GET['id'])&& isset($_GET['action']))
                    {
                        $id=(int)$_GET['id'];
                        $this->post($id);
                    }
            }
    }
    
    /**
     * Fonction qui récupère l'ensemble des données assocées à un post et les 
     * affiches dans la vue viewPostadmin ou l'article pourra être modifié.
     * @param type $postId
     */
    private function post($postId)
    {
        $this->_postManager = new PostManager();
        $post = $this->_postManager->getAllPost($postId);
        
        if($post == false)
        {
            $errors = [];
            $errors['identity'] = "Pas de post pour cet identifiant";      
                    $this->_view = new View('Error');
                    $this->_view->generate(array('errors' => $errors));
        }   else   
            {
                $this->_view = new View('Postadmin');
                $this->_view->generate(array('post' => $post));
               
            }
    }
}   

