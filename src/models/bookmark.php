<?php

class Bookmark
{
    #region

    private $_id = -1;
    private $_title = "";
    private $_url = "";
    private $_user = null;
    private $_tags = array();

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

    public function GetTitle()
    {
        return $this->_title;
    }

    public function SetTitle($title)
    {
        $this->_title = $title;
    }

    public function GetUser()
    {
        return $this->_user;
    }

    public function SetUser($user)
    {
        $this->_user = $user;
    }

    public function GetTags()
    {
        return $this->_tags;
    }

    public function SetTags($tags)
    {
        $this->_tags = $tags;
    }

    #endregion
}

?>
