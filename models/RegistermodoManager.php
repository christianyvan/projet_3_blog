<?php

/**
 * Description of RegistermodoManager
 * Classe qui vérifie l'existence d'un modo pour lequel il faut enregistrer
 * son password.
 * @author Christian
 */
class RegistermodoManager extends Model{
    
    /**
     * Fonction qui prend en paramètre l'email du visiteur et le code unique qui
     * lui a été envoyé.La fonction vérifie l'existence du code unique et de 
     * l'email correspondant dans la bdd et retourne 1 si ok, o si not ok.
     * @param type $email
     * @param type $token
     * @return type
     */
    function is_modo($email,$token)
    {
        $db = $this->getBdd();
       
        $modo = [
                'email'      => $email,
                'token'   => $token
            
        ];
        $sql = "SELECT * FROM admins WHERE email =:email AND token =:token";
        $req = $db->prepare($sql);
        $req->execute($modo);
        $exist_modo = $req->rowCount();
        return $exist_modo;
    }
}    
    