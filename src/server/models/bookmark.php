<?php

class Bookmark
{
    #region

    public $Id = -1;
    public $Title = "";
    public $URL = "";
    public $User = null;
    public $Tags = array();
   
    #endregion
    #region properties

    public function GetId()
    {
        return $this->$Id;
    }

    public function SetId($id)
    {
        $this->$Id = $id;
    }

    public function GetTitle()
    {
        return $this->$Title;
    }

    public function SetTitle($title)
    {
        $this->$Title = $title;
    }

    public function GetUser()
    {
        return $this->User;
    }

    public function SetUser($user)
    {
        $this->User = $user;
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
