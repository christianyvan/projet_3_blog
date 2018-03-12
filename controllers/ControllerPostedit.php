<?php

/**
 * Description of ControllerEditpost
 * Classe qui permet de modifier un post , cela se fait à partir d'un formulaire 
 * dans lequel on retrouve les éléments du post à modifier.
 * @author Christian
 */

class ControllerPostedit {
   
    use Controll;
    private $_view;
    private $_postManager;
   
    public function __construct($action)
    {
        if (isset($action) && count($action) > 1) 
        {
            $this->controllAction("L'action n'existe pas ou plus.");
        }   else 
            {
                if(isset($_POST['publish']))
                {
                    $title = htmlspecialchars(trim($_POST['title']));
                    $content = htmlspecialchars(trim($_POST['content']));
                    $posted = isset($_POST['public'])? 1 : 0;
                        
                    $errors = [];
                    if(empty($title)|| empty($content))
                    {
                        $errors['empty']= "Veuillez remplir tout les champs...";
                    }
                    
                }        
                
                if(!empty($errors))
                {
                    $this->_view = new View('Error');
                    $this->_view->generate(array('errors' => $errors));
                                
                }   
                else
                {
                    $this->edit($_GET['id'],$title,$content,$posted);
                }    
            }
    }
    
   
    /**
     * Fonction qui prend en paramètre les données de l'article modifié et le 
     * modifie dans la base de donnée.
     * @param type $id
     * @param type $title
     * @param type $content
     * @param type $posted
     */
    private function edit($id,$title,$content,$posted)
    {
        $this->_postManager = new PostManager();
        $this->_postManager-> updatePost($id,$title,$content,$posted);
       
        $post = $this->_postManager->getAllPost($id);
        
        if($post->content() == null)
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
 
   
    


