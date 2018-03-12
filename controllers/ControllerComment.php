<?php

require_once ('views/View.php');
require_once('controllers/ControllerPost.php'); 
                    
/**
 * Description of ControllerComment
 * Classe qui reçoit les valeurs d'un formulaire pour ajouter un commentaire
 * à un post et qui l'ajoute à la base de donner.
 * @author Christian
 */


class ControllerComment extends ControllerPost{
    
    use Controll;
    public function __construct($action)
    {
            if (isset($action) && count($action) > 1) 
        {
            $this->controllAction("L'action n'existe pas ou plus");
        }   
        else 
        {
            if(isset($_GET['action'])&& isset($_POST['submit']))
            {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $content = $_POST['postComment'];
                $postId = $_GET['id'];   
                    
                if($this->controlForm($name,$email,$content,$postId))
                {
                    $date = date(DATE_W3C);
                    $this->toComment($name,$content,$postId,$email,$seen=0,$date);
                    $this->post($postId);
                }   
            }  
        }
            if(isset($_GET['action'])&& isset($_GET['del']))
            {
                deleteComment();
            }  
        }
        
    /**
     * fonction qui ajoute un commentaire dans la bdd avec les valeurs données dans 
     * le formulaire d'ajout de commentaire.
     * @param type $name
     * @param type $content
     * @param type $postId
     * @param string $email
     * @param int $seen
     * @param type $date
     */
    protected function toComment($name,$content,$postId,$email,$seen=0,$date)
    
    {   
        $this->_commentManager = new CommentManager();
        $this->_commentManager->addComment($name,$content,$postId,$email,$seen=0,$date);
    }
  
    /**
     * fonction qui sécurise les valeurs entrées dans le formulaire et qui retourne 
     * un message au visiteur si le formulaire n'est pas rempli correctement.
     * @param type $name
     * @param type $email
     * @param type $content
     * @param type $postId
     * @return boolean
     */
    function controlForm($name,$email,$content,$postId)
    {       
        $name = htmlspecialchars(trim($name));
        $email = htmlspecialchars(trim($email));
        $content = htmlspecialchars(trim($content));
        $postId = (int)$postId;
                
        $errors = [];
        if(empty($name)|| empty($email)|| empty($content))
        {
            $errors['empty']= "Un ou plusieurs champs sont vides"; 
        }
        else 
        {
            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                $errors['email'] = "Adresse email non valide.";
            }
            
            if(!empty($errors))
            {
                $this->_view = new View('Error');
                $this->_view->generate(array('errors' => $errors));
            }
            else return true;
        }
    }
    
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