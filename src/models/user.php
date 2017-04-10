<?php

class User
{
    #region

    private $_id = -1;
    private $_name = "";
    private $_password = "";
    private $_email = "";
    private $_bookmarks = array();
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
