<?php

include_once(__DIR__ . "/factory.php");
include_once(__DIR__ . "/../models/user.php");

class UserFactory extends Factory
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
    public function GetByName($name)
    {
        return $this->SelectByName($name);
    }
    #endregion
    
    #region select
    protected function SelectById($id)
    {
        global $logger;
        $logger->debug("Selecting user by ID = " . $id);

        $mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);

        if (!$mysqli->connect_errno)
        {
            $mysqli->set_charset("utf8");
            $ergebnis = $mysqli->query("SELECT *
                                        FROM User
                                        WHERE Id = " . $id . ";");
            if (!$mysqli->errno)
            {
                $user = $this->ConvertToObject($ergebnis->fetch_assoc());
                $mysqli->close();

                return $user;
            }
        }

        $mysqli->close();

        return null;
	}
    
    public function SelectByName($name)
    {
        global $logger;
        $logger->debug("Selecting user by nane = '" . $name . "'");

        $mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);

        if (!$mysqli->connect_errno)
        {
            $mysqli->set_charset("utf8");
            $ergebnis = $mysqli->query("SELECT *
                                        FROM User
                                        WHERE Id = " . $id . ";");
            if ($mysqli->errno)
            {				
				$logger->error($mysqli->mysql_error());
			}
			else
            {
                $user = $this->Convert($ergebnis->fetch_assoc());
                $mysqli->close();

                return $user;
            }
        }

        $mysqli->close();

        return null;
    }
    #endregion
    
    #region insert
    protected function Insert($user)
    {
        global $logger;
        $logger->debug("Inserting user '".$user->GetName()."'");
        
		$name = $user->GetName();
		$password = $user->GetPassword();
		$email = $user->GetEmail();
			
		$mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);
		
		if ($mysqli->connect_errno)
		{
			$logger->error($mysqli->connect_error);
		}
		else
		{
			$mysqli->set_charset("utf8");
			$ergebnis = $mysqli->query("INSERT INTO User(Name, Password, Email)
										VALUES('".$name."', '".$password."', '".$email."');");
		}
		$mysqli->close();
	}
    #endregion
    
    #region update
    protected function Update($user)
    {
        global $logger;
        $logger->debug("Updating user '".$user->GetName()."'");
        
		$name = $user->GetName();
		$password = $user->GetPassword();
		$email = $user->GetEmail();
			
		$mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);
		
		if ($mysqli->connect_errno)
		{
			$logger->error($mysqli->connect_error);
		}
		else
		{
			$mysqli->set_charset("utf8");
			$ergebnis = $mysqli->query("UPDATE User
										SET Name='".$name.",
											Password='".$password.",
											Email='".$email.",
										WHERE Id=".$id.";");
		}
		$mysqli->close();
	}
    #endregion
    
    #region delete
    public function Delete($user)
    {
        global $logger;
        $logger->debug("Deleting user '".$user->GetName()."'");
        
		$name = $user->GetName();
		$password = $user->GetPassword();
		$email = $user->GetEmail();
			
		$mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);
		
		if ($mysqli->connect_errno)
		{
			$logger->error($mysqli->connect_error);
		}
		else
		{
			$mysqli->set_charset("utf8");
			$ergebnis = $mysqli->query("DELETE User										
										WHERE Id=".$id.";");
		}
		$mysqli->close();
	}
    #endregion
    #region convert	
    protected function ConvertToObject($dataRow)
    {
        global $logger;
        $logger->debug("Converting data row to user");
		$user = $this->Create(intval($dataRow["Id"]));
		$user->SetName($dataRow["Name"]);
		$user->SetEmail($dataRow["Email"]);
		
		return $user;
	}

    public function ConvertToAssocArray($user)
    {
        global $logger;
        $logger->debug("Converting user '" . $user->GetName() . "' to associativ array");		
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
