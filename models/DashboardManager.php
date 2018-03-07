<?php

/**
 * Description of DashboardManager
 *  Classe qui gère l'affichage de la partie haute du tableau de bord
 * @author Christian
 */
class DashboardManager extends Model
{
    /**
    * Function qui colore les encadrés du tableau de bord
    * @param type $table
    * @param type $colors
    * @return string
    */
   public function getColor($table,$colors)
   {
        if(isset($colors[$table]))
        {
           return $colors[$table];
        }   else
            {
                return "orange";
            }
   }
   
    /**
     * Fonction qui récupère le nombre de ligne pour une table données et 
     * retourne ce nombre.
     * @param type $table
     * @return type
     */
    public function inTable($table)
    {
        $db = $this->getBdd();
        $query = $db->query("SELECT id FROM  $table ");
        $number = $query->rowCount();
        return $number; 
    }
}
