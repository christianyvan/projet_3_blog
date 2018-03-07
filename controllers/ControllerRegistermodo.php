<?php
require_once ('views/View.php');

/**
 * Description of ControllerRegistermodo
 * Classe qui permet d'ajouter un modo (admin ou modo).
 * @author Christian
 */
class ControllerRegistermodo 
{
    use Controll;
    private $_registermodoManager;
    private $_view;
    
    public function __construct($action)
    {
        if (isset($action) && count($action) > 1) 
        {
            $this->controllAction("L'action n'existe pas ou plus.");
            
        }  
        else 
        {
            $this->registerModo(); 
        }
    }
    
    /**
     * Fonction qui reçoit le code unique et l'email du futur modo et lui permet
     * de créer un mot de passe en affichant la vue viewPassword pour
     * choisir un mot de passe dans le formulaire afin de pouvoir se connecter
     *  à la partie admin du site. Certain accès seront limité si il est modo
     *  et non admin.
     * @throws Exception    Si une erreur survient on affiche une page d'erreur
     */
    private function registerModo()
    {
        if(isset($_POST['submit']))
        {
            $this->_registermodoManager = new RegistermodoManager();   
            $email = htmlspecialchars(trim($_POST['email']));  
            $token = trim($_POST['token']);  
                
            if(empty($token)|| empty($email))
            {
                $errors = [];
                $errors['field']='Veuillez entrer tout les champs';
            }
            else if(($this->_registermodoManager->is_modo($email, $token))== 0)
            {
                throw new Exception("Erreur d'enregistrement.");
            }
           
            
            
            if(!empty($errors))
            {
                $this->_view = new View('Error');
                $this->_view->generate(array('errors' => $errors));
                
            }
            else
            {
                $_SESSION['admin']= $email;
                $this->_view = new View('Password');
                $this->_view->generate(array());
            }
        }   
        else
        {
            $this->_view = new View('Registermodo');
            $this->_view->generate(array());
        }
    }
}