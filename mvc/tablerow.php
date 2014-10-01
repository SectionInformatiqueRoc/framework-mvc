<?php

namespace MVC;

class TableRow {

    protected $_table;

    private function _update() {
        $attributs = get_object_vars($this);

        $query = 'update `' . $this->_table . '` set ';
        foreach ($attributs as $nom => $valeur) {
            if ($nom != 'id' and substr($nom,0,1)!='_') {
                $query.='`'.$nom.'`' . '=?,';
            }
        }
        $query = substr($query, 0, -1) . ' where id = ?';

        $id = $attributs['id'];
        unset($attributs['id']);
        unset($attributs['_table']);
        
        $params = array_values($attributs);
        $params[] = $id;
        Connexion::exec($query, $params);
    }
    private function _insert() {
        $attributs = get_object_vars($this);
        unset($attributs['_table']);
        
        $query = 'insert into `' . $this->_table . '`(`';        
        $query .= implode('`,`', array_keys($attributs));
        $query .='`) values (null' . str_repeat(',?', sizeof($attributs) - 1) . ')';

        $id = $attributs['id'];
        unset($attributs['id']);
        unset($attributs['_table']);
        $params = array_values($attributs);
        
        Connexion::exec($query, $params);
        $this->id=Connexion::get()->lastInsertId();
    }

    function copy() {
        $elem = $this;
        $elem->id = null;
        return $elem;
    }

    function store() {
        if (is_null($this->id)) {
            $this->_insert();
        } else {
            $this->_update();
        }
    }
   function delete() {
        $query = 'delete from `' . $this->_table . '` where id=?';
        Connexion::exec($query,array($this->id));
    }
}
