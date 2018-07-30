<?php

class User
{
    #region

    //Hier Vars ausnahmsweise public für JSON-Encoding
    public $Id = -1;
    public $Name = "";
    public $Password = "";
    public $Email = "";
    public $Bookmarks = array();
    public $Tags = array();

    #endregion
    #region properties

    public function GetId()
    {
        return $this->Id;
    }

    public function SetId($id)
    {
        $this->Id = $id;
    }

    public function GetName()
    {
        return $this->Name;
    }

    public function SetName($name)
    {
        $this->Name = $name;
    }

    public function GetPassword()
    {
        return $this->Password;
    }

    public function SetPassword($password)
    {
        $this->Password = $password;
    }

    public function GetEmail()
    {
        return $this->Email;
    }

    public function SetEmail($email)
    {
        $this->Email = $email;
    }

    public function GetBookmarks()
    {
        return $this->Bookmarks;
    }

    public function SetBookmarks($bookmarks)
    {
        $this->Bookmarks = $bookmarks;
    }
    
    public function AddBookmark($bookmark)
    {
    	array_push($this->Bookmarks, $bookmark);        
    }

    public function RemoveBookmark($bookmark)
    {
        // unset(array_search($bookmark, $this->Bookmarks));
    }
    
    public function GetTags()
    {
        return $this->Tags;
    }

    public function SetTags($tags)
    {
        $this->Tags = $tags;
    }
    
    public function AddTag($tag)
    {
    	array_push($this->Tags, $tag);
    }

    #endregion
}

?>
