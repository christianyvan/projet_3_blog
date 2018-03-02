<?php
require_once ('views/View.php');

/**
 * Description of ControllerAccueil
 *Classe qui permet l'affichage des posts publié (posted=1), sous forme d'extrait
 * @author Christian
 */

class ControllerHome
{
    private $_postManager;
    private $_view;
   
    /**
     * Fonction constructeur qui va permettre de transmettre aux objets créés,
     * les valeus récupéré dans la bdd sous forme d'un tableau.
     * @param type $action
     */
    public function __construct($action)
    {
        try
        {
            if (isset($action) && count($action) > 1) 
            {
                //$errors = [];
               // $errors['action']= "L'action n'existe pas ou plus";
               throw new Exception("La page n'existe pas.");
            } 
            else
            {
                 $this->posts(); 
                
            }
        
                 
        
        }
        catch (Exception $ex)
        {
            $this->_view = new View('Error');
            $this->_view->generate(array('errors' => $errors));
        }
    }
    
    /**
     * Fonction qui récupère les posts publié (posted=1)dans la bdd et les 
     * transmet en paramètres à la vue viewHome qui va gérer l'affichage.
     */
    private function posts()
    {
        $this->_postManager = new PostManager();
        $posts = $this->_postManager->getPosts_posted();
        
        if($posts == false)
        {
            $errors = [];
            $errors['action']= "Pas d'article à afficher";
            $this->_view = new View('Error');
            $this->_view->generate(array('errors' => $errors));
            
        }   else
            {
                $this->_view = new View('Home');
                $this->_view->generate(array('posts' => $posts));
            }
    }
 }

