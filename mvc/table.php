<?php

namespace MVC;

abstract class Table {

    
    abstract function getTable();
    
    function store() {
        $attributs = get_object_vars($this);

        //$query = 'update article set titre=?, texte=?, dateCreation=? where id=?';
        $query = 'update ' . $this->getTable() . ' set ';
        foreach ($attributs as $nom => $valeur) {
            if ($nom != 'id') {
                $query.=$nom . '=?,';
            }
        }
        $query = substr($query, 0, -1) . ' where id = ?';

        $connexion = Connexion::get();
        $queryPrepare = $connexion->prepare($query);
        $id = $attributs['id'];
        unset($attributs['id']);
        $parametres = array_values($attributs);
        $parametres[] = $id;

        $queryPrepare->execute($parametres);
    }

    function get($id) {
        $query = 'select * from ' . $this->getTable() . ' where id=?';
        $connexion = Connexion::get();
        $queryPrepare = $connexion->prepare($query);

        $queryPrepare->execute(array($id));
        $result= $queryPrepare->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        return $result[0];        
    }
    function delete(){
        $query = 'delete from ' . $this->getTable() . ' where id=?';
        $connexion = Connexion::get();
        $queryPrepare = $connexion->prepare($query);

        $queryPrepare->execute(array($this->id));     
    }

}
































