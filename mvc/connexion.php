<?php

namespace MVC;

class Connexion {
    
    static private $pdo=null;

    private function __construct() {
    }

    /**
     *  get() method get in \Blog\Params\BDD the correct username and password to the database
     * 
     */
    static public function get(){
        if(is_null(self::$pdo)){
            $dsn = 'mysql:dbname='.\Blog\Params\BDD::nom.';host='. \Blog\Params\BDD::host;

            try {
                self::$pdo=new \PDO($dsn, \Blog\Params\BDD::user, \Blog\Params\BDD::password);            
            } catch (PDOException $e) {
                echo 'Connexion failed : ' . $e->getMessage();
            }
            self::$pdo->exec('SET NAMES \'utf8\'');
        }
        return self::$pdo;
    }
    
    /**
     * query() method able you to only select data from you database
     * @param String $query SQL SELECT query
     * @param array $params
     * @param String $class Define the class name of the objets wich are in $rows
     * @return array
     */
    static public function query($query,$params,$class){
        $queryPrepare = self::get()->prepare($query);
        $queryPrepare->execute($params);
        $rows=$queryPrepare->fetchAll(\PDO::FETCH_CLASS,  $class);
        return $rows;
    }
    
    /**
     * exec() method able you to modify data from you database
     * @param String $query SQL MODIFICATION query
     * @param array $params
     * @return String
     */
    static public function exec($query,$params){
        $queryPrepare = self::get()->prepare($query);
        $queryPrepare->execute($params);
        
        return $queryPrepare;
    }
}
