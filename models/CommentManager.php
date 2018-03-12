<?php

/**
 * Description of CommentaireManager
 * Classe pour gérer les commentaires du blog
 * @author Christian
 */
class CommentManager extends Model
{
    /**
     * Fonction qui prend en paramètre l'identifiant de post et retourne la 
     * liste des commentaires vu qui lui son associés.
     * @param type $postId
     * @return string|\Comment
     */
    public function getComments($postId)
    {
        $listComment = [];
        
        $db = $this->getBdd();
        $req = $db->query('SELECT * FROM comments WHERE postId = '.$postId.' AND seen = 1 ORDER BY date DESC' );
        
        while($row = $req->fetch(PDO::FETCH_ASSOC))
        {
            $listComment[]= new Comment($row);
        }
        
        if ($req != false)
        {
            return $listComment;
     
        } 
        else
        { 
            $response = "Pas de commentaire pour cet article ... Soyez le premier";
            return $response;
        }
    }
    
    /**
     * Fonction qui prend en paramètre l'identifiant d'un commmentaire et 
     * supprime le commentaire associé
     * @param type $commentId
     */
    public function delComment($commentId)
    {
        $db = $this->getBdd();
        $db->exec("DELETE FROM comments WHERE id = $commentId ");
    
    }
    
    /**
     * Fonction qui prend en paramètre l'identifiant d'un post et supprime les 
     * commentaires qui lui sont associés.
     * @param type $id
     */
    public function delPostcomments($id)
    {
        $db = $this->getBdd();
        $db->exec("DELETE FROM comments WHERE postId= $id ");
    }
    
    /**
     * 
     * @param type $name
     * @param type $content
     * @param type $postId
     * @param type $email
     * @param type $seen
     */
    public function addComment($name,$content,$postId,$email='Christian Di Iorio@yahoo.fr',$seen=0)
    {
             
        $dataComment = array(
            'name'          => $name,
            'content'       => $content,
            'postId'        => $postId,
            'email'         => $email,
            'seen'          => $seen
           
        );
        
        $sql = "INSERT INTO comments(name,content,postId,email,seen,date)VALUES(:name, :content, :postId,:email,:seen, NOW())";
        $this->executeRequest($sql,$dataComment);
    }
}