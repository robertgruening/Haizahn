<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(__DIR__."/../UserStory.php");
require_once(__DIR__."/../../models/bookmark.php"); 
require_once(__DIR__."/../../factories/bookmarkFactory.php");


class createBookmark extends UserStory
{ 

    private $_bookmark = null;

    private $_user = null;
    private $_title = null;
    private $_url = null;
    private $_tags = null; 
    
#region Input Parameter

    private function getUser()
    {
        return $this->_user;
    }

    public function setUser($user)
    {
        $this->_user = $user;
    }

    private function getTitle()
    {
        return $this->_title;
    } 

    public function setTitle($title)
    {
        $this->_title = $title;
    } 
    

    private function getUrl()
    {
        return $this->_url;
    }

    public function setUrl($url)
    {
        $this->_url = $url;
    }
    

    private function getTags()
    {
        return $this->_tags;
    }

    public function setTags($tags)
    {
        $this->_tags = $tags;
    }

#endregion

#region Output Parameter

    public function getBookmark()
    {
        return $this->_bookmark;
    }

    private function setBookmark($bookmark)
    {
        $this->_bookmark = $bookmark;
    }

 #endregion

    protected function areParametersValid()
    { 
        $isValid = true;
        
        if ($this->getTitle() == null || 
            $this->getTitle() === "")
        {
            $this->addMessage("Titel ist nicht gesetzt!");  
            $isValid = false;
        }

        if ($this->getUrl() == null ||
            $this->getUrl() === "")
        {
            $this->addMessage("Url ist nicht gesetzt!");   
            $isValid = false;
        }

        if ($this->getTags() == null)
        {
            $this->addMessage("Tags ist nicht gesetzt!");   
            $isValid = false;
        }

        if ($this->getUser() == null)
        {
            $this->addMessage("Benutzer ist nicht gesetzt!");   
            $isValid = false;
        }
   
        return $isValid;
    }
      
    protected function execute()
    {
        $bookmark = new Bookmark();
          
        $bookmark->setTitle($this->getTitle());
        $bookmark->SetUrl($this->getUrl());
        $bookmark->SetTags($this->getTags());
        $bookmark->SetUser($this->getUser());

        $bookmarkFactory = new BookmarkFactory();
        
        try
        {
            $bookmarkFactory->Set($bookmark);
        }
        catch (Exception $e)
        { 
            $this->addMessage($e->getMessage());   

            return false;
        }
 
        //$this->setBookmark($bookmarkFactory->GetById($user->getUser()));
       
        return true;
    }
}