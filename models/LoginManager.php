<?php
/**
 * Classe qui permet de récupérer le mot de passe en fonction de l'email et du
 * role
 */
class LoginManager extends Model
{
    /**
     * Fonction qui prend en paramètre un email et retourne le mot de passe 
     * associé.L'email est celui d'un admin.
     * @param type $email
     * @return type
     */
    public function getHashAdmin($email)
    {
        $admin =[];
        $db = $this->getBdd();
        $req=$db->query("SELECT password FROM admins WHERE email= '$email' AND role = 'admin' ");
        
        while($row = $req->fetch(PDO::FETCH_ASSOC)){
            $admin[] = $row;
            return $admin[0]['password'];
        }
    }
    
    /**
     * Fonction qui prend en paramètre un email et retourne le mot de passe 
     * associé.L'email est celui d'un modo.
     * @param type $email   
     * @return type
     */
    public function getHashModo($email)
    {
        $modo = [];
        $db = $this->getBdd();
        $req=$db->query("SELECT * FROM admins WHERE email= '$email' AND role = 'modo' ");
       
        while($row = $req->fetch(PDO::FETCH_ASSOC)){
            $modo[] = $row;
            return $modo[0]['password'];
        }
    }    
}
    

