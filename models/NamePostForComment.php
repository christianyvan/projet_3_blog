<?php

/**
 * Description of NamePostForComment
 *  Objet class NamePostForComment extends Comment qui hérite de Comment,
 *  cet objet a été crée pour récupérer en plus des éléments d'un commentaire , 
 * le titre du post auxquel un commentaire est associé.
 * @author Christian
 */
class NamePostForComment extends Comment
{
    private $_title;
    
    public function setTitle($title)
    {
        if (is_string($title)) 
        {
            $this->_title = $title;
        }
    }
    
    public function title()
    {
         return $this->_title;
    }
}
