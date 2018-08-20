<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(__DIR__."/../UserStory.php");
require_once(__DIR__."/../../models/bookmark.php"); 
require_once(__DIR__."/../../factories/bookmarkFactory.php");


class deleteBookmark extends UserStory
{
    private $_bookmark = null; 
   
    private function getBookmark()
    {
        return $this->_bookmark;
    }

    public function setBookmark($bookmark)
    {
        $this->_bookmark = $bookmark;
    }

    protected function areParametersValid()
    { 
        $isValid = true;
        
        if ($this->getBookmark() == null || 
            $this->getBookmark() == "")
        {
            $this->addMessage("Bookmark ist nicht gesetzt!");  
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
            $bookmarkFactory->Delete($bookmark);
        }
        catch (Exception $e)
        { 
            $this->addMessage($e->getMessage());   

            return false;
        }
  
        return true;
    }
}