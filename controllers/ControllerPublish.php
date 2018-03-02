<?php
require_once ('views/View.php');
/**
 * Description of ControllerPublish
 * Classe qui permet de publier un article et de le stocker en base de donnée
 * @author Christian
 */

class ControllerPublish 
{
    
    protected $_view;
    protected $_postManager;
    protected $_commentManager;

    public function __construct($action)
    {
        if (isset($action) && count($action) > 1) 
        {
            throw new Exception('Page introuvable');
        }   else 
            {
                if(isset($_POST['publish']))
                {
                    $title = htmlspecialchars(trim($_POST['title']));
                    $name = htmlspecialchars(trim($_POST['name']));
                    $content = htmlspecialchars(trim($_POST['content']));
                    
                    $posted = isset($_POST['public'])? 1 : 0;
                        
                    $errors = [];
                   
                    if(empty($title)|| empty($content)||empty($name))
                    {
                        $errors['empty']= "Veuillez remplir tout les champs.";
                    }
                           
                    if(empty($_FILES['image']['name']))
                    {
                        $image = 'default.jpg';
                    }
                        
                    if(!empty($_FILES['image']['name']))
                    {
                        $file = $_FILES['image']['name'];
                        $extensions = ['.png','.jpg','.jpeg','.gif','.PNG','.JPG','.JPEG','.GIF'];
                        $extension = strrchr($file,'.');
                            
                        if (!in_array($extension,$extensions))
                        {
                            $errors['image']= "Extension image non valide";
                        }   else
                            {
                                $image = $file;
                            }
                    }
                            
                    if(!empty($errors))
                    {
                        $this->_view = new View('Error');
                        $this->_view->generate(array('errors' => $errors));
                    }   
                    else
                    {
                        $this->toPublish($title,$name,$content,$image,$posted);
                    }    
                }
            }
    }
   
    /**
     * Fonction qui reçoit les données d'un fomulaire pour ajouter un post dans
     * la base de données.
     * @param type $title   String  titre du post.
     * @param type $name    String  nom de l'auteur.
     * @param type $content String  contenu de l'article.
     * @param type $image   Image   image associé à l'article.
     * @param type $posted  Integer précise si le post sera publié ou pas.
     */
    private function toPublish($title,$name,$content,$image,$posted)
    {
        $this->_postManager = new PostManager();
        $this->_postManager->addPost($title,$name,$content,$image,$posted);
    }
}
     
                        

