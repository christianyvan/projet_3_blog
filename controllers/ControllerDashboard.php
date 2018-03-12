<?php

/**
 * Description of ControllerLgin
 * Classe pour gérer l'affichage du tableau de bord.
 * @author Christian
 */
class ControllerDashboard {
    use Controll;   
    private $_view;
    private $_commentManager;
    private $_dashboardManager;

    public function __construct($action)
    {
        if (isset($action) && count($action) > 1)
        {
            $this->controllAction("L'action n'existe pas ou plus");
            
        } 
        
        if(!isset($_SESSION['role']))
        {
            $this->controllAction("   Désolé, l'accès à cette page n'est pas autorisé.");
        }
        
        if(isset($_SESSION['role']))
        {
            if($_SESSION['role']=='admin' || $_SESSION['role'] =='modo')
            {
                $this->afficheDashboard();
            }
            else
            {
                $this->controllAction("   Désolé, l'accès à cette page n'est pas autorisé.");
            }
        }
    }
    
    /**
     * Fonction qui gère l'affichage du tableau de bord, la valeur de 
     * $modo['modo'] permet la désactivation des icones "valider" et "supprimer"
     *  à coté des commentaires. (ne sera pas utilisé pour donner la possibilité
     * au modo de validé ou supprimer les commentaires d'un post.
     */
    protected function afficheDashboard()
    {
        $this->_commentManager = new CommentManager();
        $this->_dashboardManager = new DashboardManager();
                
        $colorTable = [];
        $nbrInTable = [];
        $tables = [
                    "Publications"          => "posts",
                    "Commentaires"          => "comments",
                    "Administrateurs"        => "admins"
                 ];
        $colors = 
        [
            "posts"     => "blue",
            "comments"  => "green",
            "admins"    => "grey"
        ];
        foreach($tables as $table_name => $table)
        {
            $colorTable = $this->_dashboardManager->getColor($table,$colors);
            $nbrInTable[$table] = $this->_dashboardManager->inTable($table); 
        }
        
        if($_SESSION['role'] == 'admin')
        {
            $modo = [];
            $modo['modo']= 'admin';
            $comments = $this->_commentManager->getNamePostComments();
            $this->_view = new View('Dashboard');
            $this->_view->generate(array('tables' => $tables,
                'colors' => $colors,'nbrInTable' => $nbrInTable,
                'comments' => $comments,'modo' => $modo));
        }
        else 
        {
            $modo = [];
            $modo['modo']= 'modo';
            $comments = $this->_commentManager->getNamePostComments();
            $this->_view = new View('Dashboard');
            $this->_view->generate(array('tables' => $tables,
                'colors' => $colors,'nbrInTable' => $nbrInTable,
                'comments' => $comments,'modo' => $modo));
        }
    }
}

      
        
        
                        
    
    
    