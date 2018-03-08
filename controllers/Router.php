<?php
session_start();
require_once ('views/View.php');

/**
 * Description of Router
 * Classe qui en fonction de l'action du visiteur appelle le controller associé
 * qui va générer la bonne vue.
 * @author Christian
 */
class Router {
    private $_controller;
    private $_view;
    
    // chargment automatique des classes situé dans models si besoin
    public function routeReq()
    {
        try 
        {
            //chargement automatique des classes du dossiers models
            spl_autoload_register(function($class)
            {
                require_once ('models/'.$class.'.php'); 
            
            });
           
            $action = '';
            // le contrôleur est inclus selon l'action de l'utilisateur
            if(isset($_GET['action']))
            {
                $action = explode('/', filter_var($_GET['action'],FILTER_SANITIZE_URL));
                $controller = ucfirst(strtolower($action[0]));
                $controllerClass = "Controller".$controller;
                $controllerFile = "controllers/".$controllerClass.".php";
                   
                if (file_exists($controllerFile)) 
                {
                    require_once ($controllerFile);
                    $this->_controller = new $controllerClass($action);
                }
                else 
                {
                    throw new Exception('Page introuvable.........');
                }
            }
            else
            {
                require_once 'controllers/ControllerHome.php';
                $this->_controller = new ControllerHome($action);
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
}
