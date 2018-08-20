<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(__DIR__."/../UserStory.php");
require_once(__DIR__."/../../models/bookmark.php"); 
require_once(__DIR__."/../../factories/bookmarkFactory.php");


class loadBookmarks extends UserStory
{
    private $_bookmarks = array();
       
    public function getBookmarks()
    {
        return $this->_bookmarks;
    }

    private function setBookmarks($bookmarks)
    {
        $this->_bookmarks = $bookmarks;
    }

    protected function areParametersValid()
    {   
        return true;
    }
      
    protected function execute()
    {
        $bookmarks = array();          
        $bookmarkFactory = new BookmarkFactory();
         
        try
        {
            $bookmarks = $bookmarkFactory->GetAll(); 
        }
        catch (Exception $e)
        { 
            $this->addMessage($e->getMessage());   

            return false;
        }

        $this->setBookmarks($bookmarks);
       
        return true;
    }
}