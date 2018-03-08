<?php

/**
 * Description of Controll
 * trait qui permet de factoriser la création de la vue error.
 * @author Christian
 */
trait Controll
{
    /**
     * Fonction qui prend en paramètre une chaine de caractère correspondant
     * au message que l'on veut afficher dans la vue error.
     * @param type $string
     */
    function controllAction($string)
    {
        
        {
            $errors = [];
            $errors['action']="$string";
            $this->_view = new View('Error');
            $this->_view->generate(array('errors' => $errors));
        } 
    }
}