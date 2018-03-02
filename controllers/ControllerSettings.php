<?php
require_once ('views/View.php');
/**
 * Description of ControllerSettings
 * Classe qui gère l'ajout ou la suppression d'un modo
 * @author Christian
 */
class ControllerSettings {
   
    private $_settingsManager;
    private $_view;
    

    public function __construct($action)
    {
        
        if (isset($action) && count($action) > 1)
        {
            $errors = [];
            $errors['action']= "L'action n'existe pas ou plus";
            $this->_view = new View('Error');
            $this->_view->generate(array('errors' => $errors));
            
        } 
        if(!isset($_SESSION['role']))
        {
            $errors = [];
            $errors['action']= "Désolé , l'accès à cette page est impossible.";
            $this->_view = new View('Error');
            $this->_view->generate(array('errors' => $errors));
        }
        
        if(isset($_SESSION['role']))
        {
            if($_SESSION['role']=='admin')
            {
                $this->settings(); 
            }
            else
            {
                $errors = [];
                $errors['action']= "Désolé,vous n'avez pas accès à cette page";
                $this->_view = new View('Error');
                $this->_view->generate(array('errors' => $errors));
            }
        }
    }
    
    
    /**
     * Fonction qui reçoit les données d'un formulaire et qui gère l'ajout ou 
     * la suppression d'un modo(admin ou modo).
     * Avant cela, la fonction permet également l'affichage de la vue setting si
     * l'on est admin.
     * @throws Exception
     */
    private function settings()
    {
        if(isset($_POST['submit'])|| isset($_POST['submit2']))
        {
            try 
            {
                $this->_settingsManager = new SettingsManager();   
                $name = htmlspecialchars(trim($_POST['name'])); 
                $email = htmlspecialchars(trim($_POST['email']));  
                $email_again = htmlspecialchars(trim($_POST['email_again']));  
                $role = htmlspecialchars(trim($_POST['role'])); 
                       
                if(empty($name)|| empty($email)|| empty($email_again))
                {
                    throw new Exception('Veuillez entrer tout les champs');
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
                            $modos = $this->_settingsManager->getModos();
                            $this->_view = new View('Settings');
                            $this->_view->generate(array('modos' => $modos));
                        }
                    }    
                    
                    if(isset($_POST['submit2']))                       
                    {
                        $this->_settingsManager = new SettingsManager();
                        $this->_settingsManager->delModo($name, $email,$role);
                        $modos = $this->_settingsManager->getModos();
                        $this->_view = new View('Settings');
                        $this->_view->generate(array('modos' => $modos));
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
            $this->_settingsManager = new SettingsManager();
            if($_SESSION['role']== 'admin')
            {
                $modos = $this->_settingsManager->getModos();
                $this->_view = new View('Settings');
                $this->_view->generate(array('modos' => $modos));
            }
            else
            {
                header("Location:index.php?action=dashboard");
            }
        }
    }
}       