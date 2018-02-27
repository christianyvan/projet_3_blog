<?php


/**
 * Description of PasswordManager
 * Classe qui gère les mots de passe
 * @author Christian
 */
class PasswordManager extends Model{
    
    /**
     * Fonction qui encrypte le mot de passe passé en paramètre et l'ajoute à la
     * base de donnée au modo associé.
     * @param type $password
     */
    function updatePassword($password)
    {
        $options = [
            'cost'      => 11,
            'salt'      => mcrypt_create_iv(22,MCRYPT_DEV_URANDOM),
            
        ];
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        
        $db = $this->getBdd();
       
        $pw = [
                'password'      => $hash,       
                'session'       => $_SESSION['admin'] 
        ];
        
        $sql = "UPDATE admins SET password =:password WHERE email=:session" ;
        $req = $db->prepare($sql);
        $req->execute($pw);
    }
    
    /**
     * Fonction qui vérifie si un email est déjà associé à un mot de passe et
     * renvoi un si l'email n'a pas de mot de passe associé 0 sinon.
     * @return type
     */
    function hasPassword(){
        $db = $this->getBdd();
        $sql = "SELECT * FROM admins WHERE email= '{$_SESSION['admin']}' AND password = ''";
        $req = $db->prepare($sql);
        $req->execute($pw);
        $notExistPassword = $req->rowCount($sql);
        return $notExistPassword;
    }
    
    /**
     * Fonction prend en paramètre un mot de passe et vérifie qu'il n'est pas 
     * déjà dans la bdd.La fonction retourne 1 si il y a un mot de passe 
     * identique 0 sinon
     * @param type $password    String
     * @return type             Integer
     */
    function equalPassword($password){
        $db = $this->getBdd();
        $sql = "SELECT * FROM admins WHERE password = '$password'";
        $req = $db->query($sql);
        
        $ExistPassword = $req->rowCount($sql);
        return $ExistPassword;
    }
    
}
