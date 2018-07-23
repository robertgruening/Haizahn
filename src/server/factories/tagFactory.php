<?php

include_once(__DIR__ . "/factory.php");
include_once(__DIR__ . "/../models/tag.php");
include_once(__DIR__ . "/userFactory.php");

class TagFactory extends Factory
{
    #region methods
    #region create

    public function Create($id)
    {
        $tag = new Tag();
        $tag->SetId($id);

        return $tag;
    }

    #endregion
    #region get	

    public function GetByText($text)
    {
        global $logger;
        $logger->debug("Getting element by Text = '" . $text . "'");
        
        return $this->SelectByText($text);
    }

    public function GetByUser($user)
    {
        global $logger;
        $logger->debug("Getting element by User = '" . $user->GetName() . "'");
        
        return $this->SelectByUserId($user->GetId());
    }

    #endregion
    #region select

    protected function SelectById($id)
    {
        global $logger;
        $logger->debug("Selecting tag by ID (" . $id . ")");

        $mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);

        if ($mysqli->connect_errno)
        {
            $logger->error($mysqli->connect_error);
        }
        else
        {
            $mysqli->set_charset("utf8");
            $ergebnis = $mysqli->query("SELECT *
                                        FROM Tag
                                        WHERE Id = " . $id . ";");
            if ($mysqli->errno)
            {
                $logger->error($mysqli->mysql_error());
            }
            else
            {
                $tag = $this->ConvertToObject($ergebnis->fetch_assoc());
                $mysqli->close();

                return $tag;
            }
        }

        $mysqli->close();

        return null;
    }

    protected function SelectByText($text)
    {
        global $logger;
        $logger->debug("Selecting tag by text = '" . $text . "'");

        $mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);


        if ($mysqli->connect_errno)
        {
            $logger->error($mysqli->connect_error);
        }
        else
        {
            $mysqli->set_charset("utf8");
            $ergebnis = $mysqli->query("SELECT *
                                        FROM tag
                                        WHERE Text = '" . $text . "';");
            if ($mysqli->errno)
            {
                $logger->error($mysqli->mysql_error());
            }
            else
            {
                $tag = $this->ConvertToObject($ergebnis->fetch_assoc());
                $mysqli->close();

                return $tag;
            }
        }

        $mysqli->close();

        return null;
    }

    protected function SelectByUserId($userId)
    {
        global $logger;
        $logger->debug("Selecting tags by UserID = " . $userId);

        $mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);

        if ($mysqli->connect_errno)
        {
            $logger->error($mysqli->connect_error);
        }
        else
        {
            $mysqli->set_charset("utf8");
            $ergebnis = $mysqli->query("SELECT *
                                        FROM tag
                                        WHERE User_Id = " . $userId . ";");
            if ($mysqli->errno)
            {
                $logger->error($mysqli->mysql_error());
            }
            else
            {
                $tags = array();

                while ($dataRow = $ergebnis->fetch_assoc())
                {
                    array_push($tags, $this->ConvertToObject($dataRow));
                }

                $mysqli->close();

                return $tags;
            }
        }

        $mysqli->close();

        return array();
    }

    protected function SelectAll()
    {
        global $logger;
        $logger->debug("Selecting all tags");

        $elements = array();
        $mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);

        if (!$mysqli->connect_errno)
        {
            $mysqli->set_charset("utf8");
            $ergebnis = $mysqli->query("SELECT Id
                                        FROM tag;");
  
			if ($mysqli->errno)
			{
                $logger->error($mysqli->mysql_error());				
            }
            else
            {
                while ($datensatz = $ergebnis->fetch_assoc())
				{
					array_push($elements, $this->GetById(intval($datensatz["Id"])));
                }  
            }
        }

        $mysqli->close();

        return $elements;
    }
    #endregion
    #region insert

    protected function Insert($tag)
    {
        global $logger;
        $logger->debug("Inserting tag '" . $tag->GetText() . "'");

        $text = $tag->GetText();
        $userId = $tag->GetUser()->GetId();

        $mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);

        if ($mysqli->connect_errno)
        {
            $logger->error($mysqli->connect_error);
        }
        else
        {
            $mysqli->set_charset("utf8");
            $ergebnis = $mysqli->query("INSERT INTO Tag(Text, User_Id)
					VALUES('" . $text . "', " . $userId . ");");
        }
        $mysqli->close();
    }

    #endregion
    #region update

    protected function Update($tag)
    {
        global $logger;
        $logger->debug("Updating tag '" . $tag->GetText() . "'");

        $id = $tag->GetId();
        $text = $tag->GetText();
        $userId = $tag->GetUser()->GetId();

        $mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);

        if ($mysqli->connect_errno)
        {
            $logger->error($mysqli->connect_error);
        }
        else
        {
            $mysqli->set_charset("utf8");
            $ergebnis = $mysqli->query("UPDATE Tag
                                        SET Text='" . $text . "',
                                        User_Id=" . $userId . "
                                        WHERE Id=" . $id . ";");
        }
        $mysqli->close();
    }

    #endregion
    #region delete

    public function Delete($tag)
    {
        global $logger;
        $logger->debug("Deleting tag '" . $tag->GetText() . "'");

        $id = $tag->GetId();

        $mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);

        if ($mysqli->connect_errno)
        {
            $logger->error($mysqli->connect_error);
        }
        else
        {
            $mysqli->set_charset("utf8");
            $ergebnis = $mysqli->query("DELETE User
                                        WHERE Id=" . $id . ";");
        }
        $mysqli->close();
    }

    #endregion
    #region convert	

    protected function ConvertToObject($dataRow)
    {
        global $logger;
        $logger->debug("Converting data row to tag");
        $tag = $this->Create(intval($dataRow["Id"]));
        $tag->SetText($dataRow["Text"]);
        $userFactory = new UserFactory();
        $tag->SetUser($userFactory->GetById(intval($dataRow["User_Id"])));

        return $tag;
    }

    public function ConvertToAssocArray($tag)
    {
        global $logger;

        if ($tag == null)
        {
            $logger->warn("Tag to be converted to associativ array is null");

            return null;
        }


        $logger->debug("Converting tag '" . $tag->GetText() . "' to associativ array");
        $assocArray = array();
        $assocArray["Id"] = $tag->GetId();
        $assocArray["Text"] = $tag->GetText();

        return $assocArray;
    }

    #endregion
    #endregion
}

?>
