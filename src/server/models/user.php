<?php

class User
{
    #region

    //Hier Vars ausnahmsweise public für JSON-Encoding
    public $_id = -1;
    public $_name = "";
    public $_password = "";
    public $_email = "";
    public $_bookmarks = array();
    public $_tags = array();

    #endregion
    #region properties

    public function GetId()
    {
        return $this->_id;
    }

    public function SetId($id)
    {
        $this->_id = $id;
    }

    public function GetName()
    {
        return $this->_name;
    }

    public function SetName($name)
    {
        $this->_name = $name;
    }

    public function GetPassword()
    {
        return $this->_password;
    }

    public function SetPassword($password)
    {
        $this->_password = $password;
    }

    public function GetEmail()
    {
        return $this->_email;
    }

    public function SetEmail($email)
    {
        $this->_email = $email;
    }

    public function GetBookmarks()
    {
        return $this->_bookmarks;
    }

    public function SetBookmarks($bookmarks)
    {
        $this->_bookmarks = $bookmarks;
    }
    
    public function AddBookmark($bookmark)
    {
    	array_push($this->_bookmarks, $bookmark);        
    }

    public function RemoveBookmark($bookmark)
    {
        // unset(array_search($bookmark, $this->_bookmarks));
    }
    
    public function GetTags()
    {
        return $this->_tags;
    }

    public function SetTags($tags)
    {
        $this->_tags = $tags;
    }
    
    public function AddTag($tag)
    {
    	array_push($this->_tags, $tag);
    }

    #endregion
}

?>
