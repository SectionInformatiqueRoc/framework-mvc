<?php

namespace MVC;

abstract class Table {
    
    abstract function getTable();
    abstract function getClassRow();
    
    function where($where=null,$params=array()){
        $query = 'select * from `'.$this->getTable().'`';
        if(!is_null($where)){
            $query.='where '.$where;
        }
        return Connexion::query($query,$params,$this->getClassRow());        
    }
    
    function whereFirst($where,$params){
        $result= $this->where($where,$params);
        if(isset($result[0])){
            return $result[0];
        }else{
            return null;
        }
    }
    
    function get($id) {
        return $this->whereFirst('id=?', array($id));
    }
    
    function getAll($ordre=null){
        if(!is_null($ordre)){
            $ordre = '1 order by '.$ordre;
        }
        return $this->where($ordre);
    }

}
