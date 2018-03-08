<?php

/**
 * Description of ControllerDisconnection
 * Class qui permet de la déconnexion au site , donc qui supprime la session de l'utilisateur.
 * Il devra se logger à nouveau pour accéder à la partie admin
 * @author Christian
 */
class ControllerDisconnection {
    use Controll;
    
    public function __construct($action)
    {
        if (isset($action) && count($action) > 1) 
        {
            $this->controllAction("L'action n'existe pas ou plus.");
        }  
        else 
        {
            if(isset($_SESSION['admin'])&& isset($_SESSION['password']))
            {
                
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
                header("Location:index.php?action=home");
            }   
            else 
            {
                $this->controllAction("Erreur déconnexion");
            }
        }
    }
   
}
