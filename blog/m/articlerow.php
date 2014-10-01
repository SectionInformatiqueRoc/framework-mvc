<?php
namespace BLOG\M;

class ArticleRow extends \MVC\TableRow{
    protected $_table='article';
    
    public function store(){
        $tags = explode(',',$this->tags);
        unset($this->tags);
        
        parent::store();
        
        $this->deleteAllTags();
        foreach($tags as $t){
            $this->addTag(trim($t));
        }
    }
    public  function addTag($tag){
        //recherche du tag
        $tagTable=  new Tag();
        $tagRow = $tagTable->whereFirst('label=?', array($tag));
        if(is_null($tagRow)){
            $tagRow=new \MVC\TableRow();
            $tagRow->_table='tag';
            $tagRow->id=null;
            $tagRow->label=$tag;
            $tagRow->store();
        }
        
        //enregistrement dans article_tag
        $articleTag=new \MVC\TableRow();
        $articleTag->id=null;
        $articleTag->_table='article_tag';
        $articleTag->article_id=$this->id;
        $articleTag->tag_id=$tagRow->id;
        $articleTag->store();        
    }
    private function deleteAllTags(){
        $allTags=  $this->getTags();
        foreach ($allTags as $at){
            $at->delete();
        }
    }
    function getTags(){
        $articlesTags=new ArticleTag();
        
        $allTags=$articlesTags->where('article_id=?',array($this->id));
        return $allTags;
    }
    function getTagsLabel(){
        $labels=array();
        $articleTags=$this->getTags();
        
        $tagTable=new Tag();
        foreach ($articleTags as $t){
            $tag=$tagTable->get($t->tag_id);
            $labels[]=$tag->label;
        }
        return $labels;
    }
}