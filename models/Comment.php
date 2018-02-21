<?php

/**
 * Description of Comment
 *
 * @author Christian
 */
class Comment
{
    private $_id;
    private $_name;
    private $_content;
    private $_postId;
    private $_email;
    private $_seen;
    private $_date;
    
    public function __construct(array $data) 
    {
        $this->hydrate($data);
    }
    
/**
 * Fonction qui prend en paramètre une ligne de la table comments sous forme de 
 * tableau associatif (chaque nom de colonne est la clé) et qui attribut leurs valeurs a chaque attribut de la 
 * classe en utlisant le setter associé au nom de la clé.
 * @param array $data tableau associatif correspondant à une ligne de la table
 * 
 */    
    private function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if(method_exists($this,$method))
            {
                $this->$method($value);
            }
        }
    }
    
/**
* Permet d'attribuer un identifiant unique à un commentaire
* @param type $id
*/
    public function setId($id)
    {
        $id = (int)$id;
        if ($id > 0) 
        {
            $this->_id = $id;
        }
    }

/**
 * Permet d'attribuer le nom de l'auteur à un commentaire
 * @param type $name
 */    
    public function setName($name)
    {
        if (is_string($name))
        {
            $this->_name = $name;
        }
    }
    
/**
 * Permet d'attribuer le contenu du commentaire
 * @param type $content
 */
    public function setContent($content)
    {
        if (is_string($content)) 
        {
            $this->_content = $content;
        }
    }

/**
 * Permet d'attribuer au commentaire l'identifiant de l'article auquel il fait
 * référence
 * @param type $postId
 */    
    public function setPostId($postId)
    {
        $postId = (int)$postId;
        if ($postId > 0) 
        {
            $this->_postId = $postId;
        }
    }

/**
 * Permet d'attribuer l'email de l'auteur du commentaire
 * @param type $email
 */    
    public function setEmail($email)
    {
        if (is_string($email)) 
        {
            $this->_email = $email;
        }
    }
    

/**
 * Permet de définir si le commentaire a été vu (seen=1)ou pas(seen=0)
 * @param type $seen integer
 */
    public function setSeen($seen)
    {
        
        $this->_seen = $seen;
    }

/**
 * Permet d'attribuer la date courante a un commentaire
 * @param type $date Date
 */    
    public function setDate($date)
    {
        $this->_date = $date;
    }
    
    
/**
* Permet de récupérer l'identifiant du commentaire
* @return type integer
*/   
    public function id()
    {
        return $this->_id;
    }

/**
 * Permet de récupérer le nom de l'auteur du commentaire
 * @return type string
 */
    public function name()
    {
        return $this->_name;
    }

/**
 * Permet de récupérer le contenu du commentaire
 * @return type string
 */
    public function content()
    {
        return $this->_content;
    }

/**
 * Permet de récupérer l'identifiant de l'article associé au commentaire
 * @return type integer
 */
    public function postId()
    {
         return $this->_postId;
    }

/**
 * Permet de récupérer l'email de l'auteur du commentaire
 * @return type string
 */
    public function email()
    {
        return $this->_postId;
    }

/**
 * Permet de savoir si le commentaire a été vu(seen=1) ou pas(seen=0).
 * @return type integer
 */
    public function seen()
    {
         return $this->_seen;
    }

/**
 * Permet de récupérer la date de création du commentaire
 * @return type date
 */
    public function date()
    {
        return $this->_date;
    }
}

