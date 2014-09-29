<?php

namespace MVC;

abstract class Table {

    
    abstract function getTable();


    private function _update() {
        $attributs = get_object_vars($this);

        //$query = 'update article set titre=?, texte=?, dateCreation=? where id=?';
        $query = 'update ' . $this->getTable() . ' set ';
        foreach ($attributs as $nom => $valeur) {
            if ($nom != 'id') {
                $query.=$nom . '=?,';
            }
        }
        $query = substr($query, 0, -1) . ' where id = ?';

        $connexion = new \MVC\Connexion();
        $queryPrepare = $connexion->prepare($query);
        $id = $attributs['id'];
        unset($attributs['id']);
        $parametres = array_values($attributs);
        $parametres[] = $id;

        $queryPrepare->execute($parametres);
    }
    
    private function _insert() {
        $attributs = get_object_vars($this);
        $query = 'insert into ' . $this->getTable() . '(';
        $query .= implode(',',  array_keys(get_object_vars($this)));
        /*
        $query .=') values (null,';
        foreach ($attributs as $nom => $valeur) {
            if ($nom != 'id') {
                $query.='?,';
            }
        }
        $query = substr($query, 0, -1).')';
        */        
        $query .=') values (null'.  str_repeat(',?', sizeof(get_object_vars($this))-1).')';
        
 
        $connexion = new \MVC\Connexion();
        $queryPrepare = $connexion->prepare($query);
        $id = $attributs['id'];
        unset($attributs['id']);
        $parametres = array_values($attributs);
        $parametres[] = $id;

        $queryPrepare->execute($parametres);
    }
    
    function copy(){
        $elem=$this;
        $elem->id=null;
        return $elem;
    }
    
    function store(){
        if(is_null($this->id)){
            $this->_insert();
        }else{
            $this->_update();
        }
    }

    function get($id) {
        $query = 'select * from ' . $this->getTable() . ' where id=?';
        $connexion = new \MVC\Connexion();
        $queryPrepare = $connexion->prepare($query);

        $queryPrepare->execute(array($id));
        $result= $queryPrepare->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        return $result[0];        
    }
    
    function delete(){
        $query = 'delete from ' . $this->getTable() . ' where id=?';
        $connexion = new \MVC\Connexion();
        $queryPrepare = $connexion->prepare($query);

        $queryPrepare->execute(array($this->id));     
    }

}
































