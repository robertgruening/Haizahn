<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(__DIR__."/../UserStory.php");
require_once(__DIR__."/../../models/bookmark.php"); 
require_once(__DIR__."/../../factories/bookmarkFactory.php");


class loadBookmark extends UserStory
{
    private $_bookmark = null;
    private $_id = null;
      
    private function getId()
    {
        return $this->_id;
    } 

    public function setId($id)
    {
        $this->_id = $id;
    } 
  
    public function getBookmark()
    {
        return $this->_bookmark;
    }

    private function setBookmark($bookmark)
    {
        $this->_bookmark = $bookmark;
    }

    protected function areParametersValid()
    { 
        $isValid = true;
        
        if ($this->getId() == null || 
            $this->getId() == "")
        {
            $this->addMessage("Id ist nicht gesetzt!");  
            $isValid = false;
        }
  
        return $isValid;
    }
      
    protected function execute()
    {
        $bookmark = null;          
        $bookmarkFactory = new BookmarkFactory();
         
        try
        {
            $bookmark = $bookmarkFactory->GetById($this->getId()); 
        }
        catch (Exception $e)
        { 
            $this->addMessage($e->getMessage());   

            return false;
        }

        $this->setBookmark($bookmark);
       
        return true;
    }
}