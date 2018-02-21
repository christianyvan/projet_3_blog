<?php

/**
 * Description of Admin
 *
 * @author Christian
 */
class Modo {
    
    private $_id;
    private $_name;
    private $_email;
    private $_password;
    private $_token;
    private $_role;


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
* Permet d'attribuer un identifiant unique à un modérateur
* @param type $id   integer
*/    
    public function setId($id){
        $id = (int)$id;
        if ($id > 0) {
            $this->_id = $id;
        }
    }
    
/**
* Permet d'attribuer un nom à un modérateur
* @param type $name   string
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
* Permet d'attribuer l'email du modérateur
* @param type $email    string
*/
    public function setEmail($email){
        if (is_string($email)) {
            $this->_email = $email;
        }
    }
    
/**
* Permet d'attribuer un mot de passe unique à un modérateur
* @param type $password     string
*/
    public function setPassword($password){
        if (is_string($password)) {
            $this->_password = $password;
        }
    }
    
/**
* Permet d'attribuer un code unique à un modérateur.
* Ce code unique servira lors de la création d'un compte pour choisir et 
* valider un mot de passe.
* @param type $password     string
*/    
    public function setToken($token){
        if (is_string($token)) {
            $this->_token = $token;
        }
    }

/**
* Permet d'attribuer un role au modérateur, soit admin(tout les droit)
* soit modo(droit limité).
* @param type $role      string
*/    
    public function setRole($role){
        if (is_string($role)) {
            $this->_role = $role;
        }
    }
    
/**
 * Permet de récupérer l'identifiant du modérateur
 * @return type     integer
 */
    public function id(){
        return $this->_id;
    }

/**
 * Permet de récupérer le nom du modérateur
 * @return type     integer
 */
    public function name(){
        return $this->_name;
    }

/**
 * Permet de récupérer l'email du modérateur
 * @return type     integer
 */
    public function email(){
        return $this->_email;
    }
    
/**
 * Permet de récupérer le mot de passe du modérateur
 * @return type     string
 */    
    public function password(){
        return $this->_password;
    }

/**
 * Permet de récupérer le code unique du modérateur
 * @return type     string
 */
    public function token(){
        return $this->_token;
    }
     
/**
 * Permet de récupérer le role du modérateur , admin(tout les droits)
 *  ou modo(droit limité)
 * @return type     string
 */
    public function role(){
        return $this->_role;
   }
      
}
