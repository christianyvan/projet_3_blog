<?php

require_once ('views/View.php');


/**
 * Description of ControllerBlog
 * Classe qui récupère les posts en status posted dans la bdd 
 * et les affiches à l'écran sous forme d'extrait
 * @author Christian
 */

class ControllerBlog 
{
    use Controll;
    private $_postManager;
    private $_view;
    
    public function __construct($action)
    {
        if (isset($action) && count($action) > 1)
        {
            throw new Exception('Page introuvable');
        }   else 
            {
                $this->posts(); 
            }
    }
   
    /**
     * Description of function posts
     * fonction qui récupère les posts en status posted=1 et les affiche sous 
     * forme d'extrait. Si la liste des posts est vide, un message est affiché
     */
    private function posts()
    {
        $this->_postManager = new PostManager();
        $posts = $this->_postManager->getPosts();
        if($posts == false)
        {
            $this->controllAction("Pas de post de disponible pour le moment");
        }
        else
        {
            $this->_view = new View('Blog');
            $this->_view->generate(array('posts' => $posts));
        }
    }
}

