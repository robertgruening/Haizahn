<?php

class Tag
{
    #region

    private $_id = -1;
    private $_text = "";
    private $_user = null;
    private $_bookmarks = array();

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

    public function GetText()
    {
        return $this->_text;
    }

    public function SetText($text)
    {
        $this->_text = $text;
    }

    public function GetUser()
    {
        return $this->_user;
    }

    public function SetUser($user)
    {
        $this->_user = $user;
    }

    public function GetBooksmarks()
    {
        return $this->_bookmarks;
    }

    public function SetBookmarks($bookmarks)
    {
        $this->_bookmarks = $bookmarks;
    }

    #endregion
}

?>
