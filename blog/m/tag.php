<?php
namespace BLOG\M;

class Tag extends \MVC\Table{
    function getTable() {
        return 'tag';
    }
    public function getClassRow() {
        return '\MVC\TableRow';
    }
}