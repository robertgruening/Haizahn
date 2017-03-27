<?php

include_once(__DIR__ . "/../config.php");
include_once(__DIR__ . "/config.db.php");
include_once(__DIR__ . "/../models/user.php");

class UserFactory
{
    #region methods
    #region create

    public function Create($id)
    {
        $user = new User();
        $user->SetId($id);

        return $user;
    }

    #endregion
    #region get	

    public function Get($id)
    {
        global $logger;
        $logger->debug("Getting user by ID (" . $id . ")");

        $mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);

        if (!$mysqli->connect_errno)
        {
            $mysqli->set_charset("utf8");
            $ergebnis = $mysqli->query("SELECT *
                                        FROM User
                                        WHERE Id = " . $id . ";");
            if (!$mysqli->errno)
            {
                $datensatz = $ergebnis->fetch_assoc();
                $user = $this->Create(intval($datensatz["Id"]));
                $user->SetName($datensatz["Name"]);
                $user->SetEmail($datensatz["Email"]);

                $mysqli->close();

                return $user;
            }
        }

        $mysqli->close();

        return null;
    }

    #endregion
    #region set
    #endregion
    #region delete
    #endregion
    #region convert	

    public function ConvertToAssocArray($user)
    {
        $assocArray = array();
        $assocArray["Id"] = $user->GetId();
        $assocArray["Name"] = $user->GetName();
        $assocArray["Email"] = $user->GetEmail();

        return $assocArray;
    }

    #endregion
    #endregion
}

?>
