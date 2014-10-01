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
        if(trim($tag)!=''){
            $tagTable=  new Tag();
            $tagRow = $tagTable->whereFirst('label=?', array($tag));
            if(is_null($tagRow)){
                $tagRow=$tagTable->newItem();
                $tagRow->label=$tag;
                $tagRow->store();
            }

            //enregistrement dans article_tag
            $articleTagTable=new ArticleTag();
            $articleTag=$articleTagTable->newItem();
            $articleTag->article_id=$this->id;
            $articleTag->tag_id=$tagRow->id;
            $articleTag->store();        
        }
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
    
    function getCommentaires(){
        $commentaireTable = new Commentaire();
        
        $commentaires = $commentaireTable->where('article_id=?',array($this->id));
        return $commentaires;
    }
    function addCommentaire($texte,$auteur){
        $commentaireTable = new Commentaire();
        $commentaire=$commentaireTable->newItem();
        
        $commentaire->texte=$texte;
        $commentaire->article_id=$this->id;
        $commentaire->auteur=$auteur;
        $commentaire->date=date('Y-m-d H:i:s');
        $commentaire->store();
        
    }
}