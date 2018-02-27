<?php
require_once ('views/View.php');
    
/**
 * Description of ControleurArticle
 * Classe qui gère les posts
 * @author Christian
 */


class ControllerPost 
{
    private $_postManager;
    private $_commentManager;
    private $_view;
   
    public function __construct($action)
    {
        if (isset($action) && count($action) > 1) 
        {
            $errors = [];
            $errors['action']= "L'action n'existe pas ou plus";
            $this->_view = new View('Error');
            $this->_view->generate(array('errors' => $errors));
        }   
        else 
        {
            if(isset($_GET['id']))
            {
                $id=(int)$_GET['id'];
                $this->post($id);
            } 
                
            if(isset($_GET['delete'])&& isset($_GET['action']))
            {
                $id=(int)$_GET['delete'];
                $this->deletePost($id);
            }
        }
    }
    
    /**
     * Fonction qui récupère pour un post donné, tous ses commentaires.
     * Le post et les commentaires sont passés en paramètre à la vue qui va 
     * gérer leurs affichage.
     * nb:cette fonction est en protected car utiliser dans ControllerComment.
     * @param type $postId
     */
    protected function post($postId)
    {
        $this->_postManager = new PostManager();
        $this->_commentManager = new CommentManager();
        $post = $this->_postManager->getPost($postId);
        $comments = $this->_commentManager->getComments($postId);
                
        if($post == false)
        {
            
            $errors = [];
            $errors['postnotexist']= "Ce post n'existe pas";
            $this->_view = new View('Error');
            $this->_view->generate(array('errors' => $errors));
            
        }  
        else
        {
            if($post->posted()== 1 )//0n affiche le post et les commentaires associés
            {
                $this->_view = new View('Post');
                $this->_view->generate(array('post' => $post,'comments'=> $comments));
            }   
        }
    }
    
    /**
     *  Fonction qui gère la suppression d'un post et des articles qui lui sont 
     * associés. nb: je n'ai pas mis de relation dans la base de donnée entre 
     * les tables posts et comments.
     * @param type $id
     */
    private function deletePost($id)
    {
        $this->_postManager = new PostManager();
        $this->_commentManager = new CommentManager();
        $this->_postManager->delPost($id);
        $this->_commentManager->delComment($id);
        $posts = $this->_postManager->getAllPosts();
        $this->_view = new View('listpost');
        $this->_view->generate(array('posts' => $posts));
    }
}