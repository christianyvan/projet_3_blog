<?php

/**
 * Description of SettingsManger
 * Classe qui vérifie si l'email entrée dans le formulaire pour ajouter un modo
 * n'est pas déjà dans la base de donné.
 * @author Christian
 */
class SettingsManager extends Model{
    
    /**
     * Fonction qui vérifie si l'émail passé en paramètre est déja pris.
     * Elle retourne 1 si l'émail est pris ,0 sinon.
     * @param type $email
     * @return type
     */
    function emailTaken($email)
    {
        $db = $this->getBdd();
        $mail = ['email' => $email];
        $sql = "SELECT * FROM admins WHERE email =:email";
        $req = $db->prepare($sql);
        $req->execute($mail);
        $free = $req->rowCount($sql);
        return $free;
        
    }
    
    /**
     * Fonction qui supprime un modérateur de la table admins(admin ou modo)en 
     * fonction des données passées en paramètres.
     * @param type $name    String
     * @param type $email   String
     * @param type $role    String
     */
    public function delModo($name,$email,$role)
    {
        $db = $this->getBdd();
        $modo = [
                'name'            => $name,   
                'email'           => $email,
                'role'            => $role
                           
                ];
        $sql = "DELETE FROM admins WHERE name =:name AND email =:email AND role =:role";
        $req = $db->prepare($sql);
        $req->execute($modo);
        
    }
    
    /**
     * Fonction qui ajoute un modérateur de la table admins(admin ou modo)en
     * fonction des données passées en paramètres.
     * Un email est envoyé à l'utilisateur avec un code unique pour créer son 
     * mot de passe et valider ses droits d'accès.
     * @param type $name
     * @param type $email
     * @param type $token
     * @param type $role
     */
    function addModo($name,$email,$token,$role)
    {
        $db = $this->getBdd();
        $modo = [
                'name'      => $name,   
                'email'     => $email,
                'token'     => $token,
                'role'      => $role
                
                ];
        $sql = "INSERT INTO admins (name,email,token,role)"
                ." VALUES(:name,:email,:token, :role)";
                
        $req = $db->prepare($sql);
        $req->execute($modo);
        
        $subject = "Enregistrement sur le blog";
        $message = 
                '<html lang="en" style="font-family:sans-serif;">
                        <head>
                            <meta charset="utf-8">
                        </head>
                    <body>
                        Voici votre identifiant et code unique à insérer sur
                        <a href="http://localhost/projet_3_cpm_blog/index.php?action=registermodo" >Créer le mot de passe</a>
                        
                        <br/>Identifiant: '.$email.'
                        <br/>Mot de passe: '.$token.'
                        <br/>Vous êtes: '.$role.'
                        <br/><br/>Après avoir insérer ces informations , vous devez choisir un mot de passe
                    </body>
                </html>';
        
                $header = "MIME-Version: 1.0\r\n";
                $header .= "Content-type:text/html;charset=utf-8\r\n";
                $header .="From: no-reply@christian.fr" . "\r\n" . "Reply-to:christian_diiorio@yahoo.fr" . "\r\n";
                
                mail($email,$subject,$message,$header);
    }
    
    /**
     * Fonction qui génère un code unique.
     * @param type $length
     * @return type string
     */
    function generateToken($length)
    {
        $token ="azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789";
        return substr(str_shuffle(str_repeat($token, $length)),0,$length);
    }
    
    /**
     * Fonction qui récupère la liste des modos de la base admins sous forme
     * d'objets Modo et les retourne dans un tableau.
     * @return \Modo
     */
    function getModos()
    {
        $db = $this->getBdd();
        $req = $db->query("
                SELECT * FROM admins
                ");
        $listModo = [];
        while($row = $req->fetch(PDO::FETCH_ASSOC))
        {
            $listModo[]= new Modo($row);
        }
       
        return $listModo;
    }
} 
   