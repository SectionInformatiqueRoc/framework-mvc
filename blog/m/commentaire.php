<?php
namespace BLOG\M;

class Commentaire extends \MVC\Table{
    
    public function getTable() {
        return 'commentaire';
    }
    public function getClassRow() {
        return '\MVC\TableRow';
    }
}