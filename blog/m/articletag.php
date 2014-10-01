<?php
namespace BLOG\M;

class ArticleTag extends \MVC\Table{
    function getTable() {
        return 'article_tag';
    }
    public function getClassRow() {
        return '\MVC\TableRow';
    }
}