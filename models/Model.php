<?php

/**
 * Description of Model
 *
 * @author Christian
 * di ioirio 
 */
abstract class Model
{
    
    private static $_bdd;
    
    // instancie la connexion à la bdd
    private static function setBdd(){
        try 
        {
             self::$_bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8','root','',
             array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8',PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        } 
            catch (Exception $ex) 
            {
                die("Erreur de connexion");
            }
    }
    
    /**
     * 
     * @return type
     */
    protected function getBdd(){
        if (self::$_bdd == null) {
            $this->setBdd();
        }
        return self::$_bdd;
    }
    
    // fonction générique permettant d'exécuter un requête, éventuellement paramétrés
    protected function executeRequest($sql,$params = null){
        if($params == null){
            $result = $this->getBdd()->query($sql); // pas de paramêtre , l'exécution n'est pas préparé
        }
        else{
            $result = $this->getBdd()->prepare($sql); // requête préparé
            $result->execute($params);
        }
        return $result;
    }
    
    /**
     * Fonction qui prend en paramêtre la table sur laquelle la requête va s'exécuter,
     *  et le nom de l'objet qui lui récupère le résultat de la requête.
     * @param type $table  contient la table sur laquelle la requête va s'exécuter
     * @param type $obj    contient un objet du type de la table (Article, Commentaire,..)
     * @return \obj $var est un tableau d'objet de type $obj
     */
    
    protected function getAll($table,$obj){
        $listObj = [];
        $req = self::$_bdd->prepare('SELECT * FROM '.$table.' ORDER BY id DESC');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $listObj[] = new $obj($data);
        }
        $req->closeCursor();
        return $listObj;
    }
}
