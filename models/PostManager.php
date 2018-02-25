<?php

/**
 * Description of ArticleManager
 *
 * @author Christian
 */
class PostManager extends Model
{

/**
 * Fonction qui retourne tout les posts sous forme d'objet Post dans un tableau
 * Seul les posts avec le status publié sont retourné (posted=1)
 * @return $listPost tableau d'objets
 */   
    public function getPosts()
    {
        $listPost = [];
        $db = $this->getBdd();
        
        $req = $db->query('SELECT *FROM posts WHERE posted=1 '
                                .'ORDER BY posts.date DESC
                                ');
      
        while($row = $req->fetch(PDO::FETCH_ASSOC))
        {
           
            $listPost[]= new Post($row);
        }
            return $listPost;
    }
     
    /**
     * Fonction qui prend en paramètre l'identifiant d'un post et qui retourne
     * ses valeurs sous forme d'objet Post si son status est publié(posted=1).
     * @param type $postId
     * @return \Post
     */
    public function getPost($postId)
    { 
       
        $postId = (int)$postId;
        
        $db = $this->getBdd();
        $req = $db->query('SELECT * FROM posts WHERE posts.id = '.$postId. 
                            ' AND posts.posted = 1 ORDER BY posts.date DESC' );
                            
        if($req->rowCount()== 1)
        {
            $post = $req->fetch(PDO::FETCH_ASSOC);
            return new Post($post);
        }
    }
   
    /**
     * Fonction qui retourn un post sous forme d'objet Post, quelque soit sont 
     * status, publié(posted=1) ou pas(posted=0).
     * @param type $postId
     * @return \Post
     */
    public function getAllPost($postId)
    { 
       
        $postId = (int)$postId;
        
        $db = $this->getBdd();
        $req = $db->query('SELECT * FROM posts WHERE posts.id = '.$postId. 
                            ' ORDER BY posts.date DESC' );
                            
        if($req->rowCount()== 1)
        {
            $post = $req->fetch(PDO::FETCH_ASSOC);
            return new Post($post);
        }
    }
    
    /**
     * Fonction qui ajoute un post dans la table posts
     * @param type $title
     * @param type $name
     * @param type $content
     * @param type $image
     * @param type $posted
     */
    public function addPost($title,$name,$content,$image,$posted)
    {
        $publication = [
                        'title'      => $title,
                        'name'       => $name,
                        'content'    => $content,
                        'image'      => $image,
                        'posted'     => $posted,
                        'email'      => $_SESSION['admin']
        ];
        
        $db = $this->getBdd();
        $sql = "INSERT INTO posts(title,name,content,email,image,date,posted)
                VALUES(:title,:name,:content,:email,:image,NOW(),:posted)
                ";
        $req = $db->prepare($sql);
        $req->execute($publication);
        $id = $db->lastInsertId();
        if($posted==1)
        {
             header("Location:index.php?action=post&id=".$id);
        }
            else
            {
                header("Location:index.php?action=write");
            }
    }   
    
  
/**
 * Fonction qui prend en paramètre l'id du post à supprimer.
 * Tous les commentaires qui lui sont associés sont également supprimés.
 * 
 * @param type $id      integer
 */
    public function deletePost($id)
    {
        $db = $this->getBdd();
        $db->exec("DELETE FROM posts WHERE id = $id ");
        $db->exec("DELETE FROM comments WHERE postId = $id ");
    }
  
/**
 * Fonction qui met à jour un post
 * @param type $id
 * @param type $title
 * @param type $content
 * @param type $posted
 */    
    public function updatePost($id,$title,$content,$posted)
    {
        $db = $this->getBdd();
        $postUpdate = [
            'id'        => $id,
            'title'     => $title,
            'content'   => $content,
            'posted'    => $posted 
            
        ];
          
        $sql = "UPDATE posts 
                SET title=:title,content=:content,date=now(),posted=:posted 
                WHERE id=:id";
        $req = $db->prepare($sql);
        $req->execute($postUpdate);
        
        
    }
    
/**
 * Fonction qui ajoute une image au dernier post ajouté dans la table posts
 * @param type $tmp_name
 * @param type $extension
 */    
    public function postImage($tmp_name,$extension)
    {
        $db = $this->getBdd();
        $id = $db->lastInsertId();
        $image = [
                'id'     => $id,
                'image'  => $id.$extension
            
        ];
        
        $sql = "UPDATE posts SET image = :image WHERE id = :id";
        $req = $db->prepare($sql);
        $req->execute($id);
        move_uploaded_file($tmp_name,"img/posts/".$id.$extension);
        header("Location:index.php?action=post&id=".$id);

    }
}

