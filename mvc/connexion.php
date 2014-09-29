<?php

namespace MVC;

class Connexion extends \PDO {

    function __construct() {
        $dsn = 'mysql:dbname='.\Blog\Params\BDD::nom.';host='. \Blog\Params\BDD::host;
        
        try {
            parent::__construct($dsn, \Blog\Params\BDD::user, \Blog\Params\BDD::password);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
        $this->exec('SET NAMES \'utf8\'');
    }

}

?>
