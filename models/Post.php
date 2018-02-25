<?php


/**
 * Description of Post
 *Classe qui réprésente une ligne de la table post sous forme d'objet Post
 * @author Christian
 */

class Post 
{
    private $_id;
    private $_title;
    private $_name;
    private $_content;
    private $_email;
    private $_image;
    private $_date;
    private $_posted;


    public function __construct(array $data) 
    {
        $this->hydrate($data);
    }
    
/**
 * Fonction qui prend en paramètre une ligne de la table comments sous forme de 
 * tableau associatif (chaque nom de colonne est la clé) et qui attribut leurs valeurs a chaque attribut de la 
 * classe en utlisant le setter associé au nom de la clé.
 * @param array $data tableau associatif correspondant à une ligne de la table
 */        
    public function hydrate(array $data)
    { 
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);// $key correspond au nom de chaque colonne de la table posts
            if(method_exists($this,$method))
            {
                $this->$method($value);
            }
        }
    }

/**
* Permet d'attribuer un identifiant unique à un post
* @param type $id
*/    
    public function setId($id){
        $id = (int)$id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }
    
/**
 * Permet d'attribuer un titre à un post
 * @param type $title string
 */    
    public function setTitle($title){
        if (is_string($title)) {
            $this->_title = $title;
        }
    }

/**
 * Permet d'attribuer le nom de l'auteur du post
 * @param type $name    string
 */    
    public function setName($name){
        if($name==''){
            $this->_name = 'Jean Forteroche';
        }
       elseif (is_string($name)&& $name != '') {
            $this->_name = $name;
        }
    }

/**
 * Permet d'attribuer le contenu du post
 * @param type $content
 */
    public function setContent($content){
        if (is_string($content)) {
            $this->_content = $content;
        }
    }

/**
 * Permet d'attribuer l'email de l'auteur du post
 * @param type $email
 */     
    public function setEmail($email){
        if (is_string($email)) {
            $this->_email = $email;
        }
    }

/**
 * Permet d'attribuer une image à un post
 * @param type $image
 */    
    public function setImage($image= ''){
        if($image === ''){$this->_image = 'alaska.jpg';}
     elseif (is_string($image)) {
            $this->_image = $image;
        }
    }

/**
 * Permet d'attribuer la date courante a un post
 * @param type $date Date
 */      
    public function setDate($date){
       
         $this->_date = $date;
    }

/**
 * Permet de définir si le post a été mis en ligne(posted=1)ou pas(posted=0)
 * @param type $seen integer
 */
    public function setPosted($posted){
        $this->_posted = $posted;
    }
    
/**
* Permet de récupérer l'identifiant du post
* @return type integer
*/
    public function id(){
         return $this->_id;
    }

/**
 * Permet de récupérer le titre du post
 * @return type string
 */
    public function title(){
         return $this->_title;
    }
    
/**
 * Permet de récupérer le nom du post
 * @return type string
 */    
    public function name(){
        return $this->_name;
    }

/**
 * Permet de récupérer le contenu du post
 * @return type string
 */    
    public function content(){
        return $this->_content;
    }

/**
 * Permet de récupérer le mail de l'auteur du post
 * @return type string
 */    
    public function email(){
        return $this->_email;
    }

/**
 * Permet de récupérer l'image associé au post
 * @return type string
 */
    public function image(){
        return $this->_image;
    }
     
/**
 * Permet de récupérer la date de création du post
 * @return type date
 */
    public function date(){
        return $this->_date;
    }
    
/**
 * Permet de récupérer la valeur de posted et donc de savoir si le post a été
 * publié (posted=1) ou pas(posted=0).
 * @return type integer
 */    
     public function posted(){
        return $this->_posted;
    }
}


