<?php

/**
 * Description of View
 *  
 * @author Christian
 */
class View {
    private $_file;
   
    public function __construct($action) {
        $this->_file = 'views/view'.$action.'.php'; // ex avec views/viewPost
    }
    
    /**
     * Fonction qui prend en paramètre un tableau de tableaux de données, 
     * données qui seront passées en paramètre à la vue pour affichage.
     * La vue est généré par la fonction interne generateFile.
     * @param type $data    Tableau de tableau de données.
     */
    public function generate($data){ 
        // partie spécifique de la vue
        $content = $this->generateFile($this->_file,$data);
        
    }
    
    /**
     * Fonction qui prend en paramètre le fichier vue à utiliser pour afficher 
     * les données et les données à passer en paramètre à la vue pour affichage.
     * @param type $file    fichier vue à utiliser
     * @param type $data    tableau de tableaux de données passées en paramètre
     *  à la vue
     * @return type
     * @throws Exception
     */
    private function generateFile($file,$data){ 
        if (file_exists($file)) {
            extract($data);
            ob_start();
            // on inclut le fichier vue
            require $file;
            return ob_get_clean();
        } else {
            throw new Exception('Fichier ' . $file . ' introuvable');
        }
    }
}
