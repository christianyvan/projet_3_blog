<?php
require_once ('views/View.php');


/**
 * Description of ControllerPassword
 * Classe qui crée un nouveau modo dans la base de donnée.
 * @author Christian
 */
class ControllerPassword {
    use Controll;
    private $_view;
    private $_passwordManager;
    
    public function __construct($action)
    {
        if (isset($action) && count($action) > 1) 
        {
            $this->controllAction("L'action n'existe pas ou plus.");
        }
        else 
        {
            $this->registerPassword(); 
        }
    }
    
    /**
     * Fonction qui vérifie la validité du mot de passe donner par l'utilisateur
     * lors de son enregistrement. Si le password est valide il sera crypté et 
     * ajouté à la base de données.
     * Le visiteur est redirigé sur la page du tableau de bord.
     * @throws Exception
     */
    private function registerPassword()
    {
        if(isset($_POST['pwd']))
        {
            $this->_passwordManager = new PasswordManager();   
            $errors = [];
            $password = htmlspecialchars(trim($_POST['password']));  
            $password_again = htmlspecialchars(trim($_POST['password_again']));  
                
            if(empty($password)|| empty($password_again))
            {
                $errors['field']='Veuillez entrer tout les champs';
            }
            else if($password != $password_again)
            {
                $errors['pwd']='Les mots de passe sont différents';
            }
            
            if($this->_passwordManager->equalPassword($password)== 1)
            {
                $errors['exist_pwd']='Ce mot de passe existe déjà';
            }
            
            if(!empty($errors)) 
            {
                $this->_view = new View('Error');
                $this->_view->generate(array()); 
            }
            else
            {
                $this->_passwordManager->updatePassword($password);
				$_SESSION = array();
                    
                if (ini_get("session.use_cookies"))
                {
                    $params = session_get_cookie_params();
                    
                    setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                    );
                }
                session_destroy();
                header("Location:index.php?action=login");
                             
            }
        }   
    }   
}

