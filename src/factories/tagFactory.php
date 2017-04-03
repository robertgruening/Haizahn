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
    #endregion
    #region set
    #endregion
    #region delete
    #endregion
    #region convert	

    public function ConvertToAssocArray($tag)
    {
        $assocArray = array();
        $assocArray["Id"] = $tag->GetId();
        $assocArray["Text"] = $tag->GetText();
        $userFactory = new UserFactory();
        //$assocArray["User"] = $userFactory->ConvertToAssocArray($tag->GetUser());

        return $assocArray;
    }

    protected function ConvertToObject($dataRow)
    {
        
    }

    public function Delete($object)
    {
        
    }

    protected function Insert($object)
    {
        
    }

    protected function SelectById($id)
    {
        global $logger;
        $logger->debug("Selecting tag by ID (" . $id . ")");

        $mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);

        if (!$mysqli->connect_errno)
        {
            $mysqli->set_charset("utf8");
            $ergebnis = $mysqli->query("SELECT *
                                        FROM tag
                                        WHERE Id = " . $id . ";");
            if (!$mysqli->errno)
            {
                $datensatz = $ergebnis->fetch_assoc();
                $tag = self::Create(intval($datensatz["Id"]));
                $tag->SetText($datensatz["Text"]);
                $tag->SetUser($datensatz["User_Id"]);

                $mysqli->close();

                return $tag;
            }
        }

        $mysqli->close();

        return null;
    }

    protected function Update($object)
    {
        
    }

    #endregion
    #endregion
}

?>
