<?php
require_once ('views/View.php');
/**
 * Description of ControllerSettings
 * Classe qui gère l'inscription d'un modo
 * @author Christian
 */
class ControllerInscription {
    use Controll;
    private $_settingsManager;
    private $_view;
    

    public function __construct($action)
    {
        
        if (isset($action) && count($action) > 1)
        {
            $this->controllAction("L'action n'existe pas ou plus.");
        } 
        else
        {
            $this->register();
        }
    }
    
    
    /**
     * Fonction qui reçoit les données d'un formulaire et qui gère l'ajout ou 
     * la suppression d'un modo(admin ou modo).
     * Avant cela, la fonction permet également l'affichage de la vue setting si
     * l'on est admin.
     * @throws Exception
     */
    private function register()
    {
        if(isset($_POST['submit']))
        {
            try 
            {
                $this->_settingsManager = new SettingsManager();   
                $name = htmlspecialchars(trim($_POST['name'])); 
                $email = htmlspecialchars(trim($_POST['email']));  
                $email_again = htmlspecialchars(trim($_POST['email_again']));  
                $role = 'modo'; 
                       
                if(empty($name)|| empty($email)|| empty($email_again))
                {
                    throw new Exception('Veuillez entrer tout les champs');
                }
                
                if(!filter_var($email,FILTER_VALIDATE_EMAIL))
                {             
                    $errors['email'] = "Adresse email non valide.";
                }
                
                if($email != $email_again)
                {
                    throw new Exception('Veuillez entrer des emails identiques');
                }
                else
                {
                    if(isset($_POST['submit']))                       
                    {
                        if($this->_settingsManager->emailTaken($email))
                        {
                            throw new Exception('Email déjà utilisé');
                        }
                        else
                        {
                            $this->_settingsManager = new SettingsManager();
                            $token = $this->_settingsManager->generateToken(30);
                            $this->_settingsManager->addModo($name, $email,$token,$role);
                            header("Location:index.php?action=home");
                        }
                    }    
                }                   
            }
            catch (Exception $ex) 
            {
                $errors = [];
                $errors['action'] = $ex->getMessage();
                $this->_view = new View('Error');
                $this->_view->generate(array('errors' => $errors)); 
            }
        }  
        else
        {
            $this->_view = new View('Inscription');
            $this->_view->generate(array());
        }
    }
}       