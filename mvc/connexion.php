<?php

namespace MVC;

class Connexion {
    
    static private $pdo=null;

    private function __construct() {
    }

    static public function get(){
        if(is_null(self::$pdo)){
            $dsn = 'mysql:dbname='.\Blog\Params\BDD::nom.';host='. \Blog\Params\BDD::host;

            try {
                self::$pdo=new \PDO($dsn, \Blog\Params\BDD::user, \Blog\Params\BDD::password);            
            } catch (PDOException $e) {
                echo 'Connexion échouée : ' . $e->getMessage();
            }
            self::$pdo->exec('SET NAMES \'utf8\'');        
            var_dump(self::$pdo);
        }
        return self::$pdo;
    }
    
    static public function query($query,$params){
        $queryPrepare = self::get()->prepare($query);
        $queryPrepare->execute($params);
        $rows=$queryPrepare->fetchAll(\PDO::FETCH_CLASS,  get_called_class());
        return $rows;

    }
}

?>
