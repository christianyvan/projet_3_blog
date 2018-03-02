<?php

require_once ('views/View.php');

/**
 * Description of ControllerAdmin
 * Classe qui permet l'accès à la partie administrarion du site
 * @author Christian
 */
class ControllerLogin {
    private $_view;
    private $_loginManager;
    


    public function __construct($action)
    { 
        if (isset($action) && count($action) > 1) 
        {
            throw new Exception('Page introuvable');
        }  
        else
        {
            $this->controllLogin();
        }
    }
    
    /**
     * Fonction qui vérifie la validité de l'émail et du mot de passe lorsque 
     * l'on veut se logguer pour accéder à la partie administration du site.
     * Si l'action de l'utilisateur est login, le formulaire de connection est 
     * affiché.
     */
    private function controllLogin(){
        
        if(isset($_SESSION['admin']))
        {
            header("Location:index.php?action=dashboard");
        }
        
        if(isset($_POST['submit']))
        {
            $this->_loginManager = new LoginManager();
            $email = htmlspecialchars(trim($_POST['email']));
            $password = htmlspecialchars(trim($_POST['password']));
                
            $hashadmin = $this->_loginManager->getHashAdmin($email);
            $hashmodo  = $this->_loginManager->getHashModo($email);
            $errors = [];
                
            if(empty($email)|| empty($password))
            {
                $errors['empty']= "Un ou plusieurs champs sont vides !";
            }   
                                        
            if($hashadmin != "" && $hashmodo == null)
            {
                $bool = password_verify($password, $hashadmin);
               
                if($bool == FALSE)
                {
                    $errors['password']= "Le mot de passe n'est pas valide pour cet admin";
                }
                else
                {
                    $_SESSION['role']= 'admin';
                    $_SESSION['admin'] = $email;
                    $_SESSION['password'] = $password;
                    header("Location:index.php?action=dashboard"); 
                    
                }
            }   
                     
            if($hashmodo != "" && $hashadmin == null)
            {
                $bool = password_verify($password, $hashmodo);
                if($bool == FALSE)
                {
                    $errors['password']= "Le mot de passe n'est pas valide pour ce modo";
                }
                else
                {
                    $_SESSION['role']= 'modo';
                    $_SESSION['admin'] = $email;
                    $_SESSION['password'] = $password;
                    header("Location:index.php?action=dashboard"); 
                }
            }
            
            if($hashadmin == null && $hashmodo == null)
            {
                $errors['password']= "Problème d'identification.";
            }
                    
            if(!empty($errors))
            {
                $this->_view = new View('Error');
                $this->_view->generate(array('errors' => $errors));
            }  
        }
        else
        {  // si le formulaire n'a pas été rempli et que l'action est login on arrive sur la page login
            $this->_view = new View('Login');
            $this->_view->generate(array());
        }
    }  
}    