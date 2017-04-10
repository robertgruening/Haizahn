<?php

include_once(__DIR__ . "/factory.php");
include_once(__DIR__ . "/userFactory.php");
include_once(__DIR__ . "/../models/bookmark.php");

class BookmarkFactory extends Factory
{
    #region methods
    #region create
    public function Create($id)
    {
        $bookmark = new Bookmark();
        $bookmark->SetId($id);

        return $bookmark;
    }
    #endregion
    
    #region get 
    public function GetByUser($user)
    {
        return $this->SelectByUserId($user->GetId());
    }
    #endregion
    
    #region select
    protected function SelectById($id)
    {
        global $logger;
        $logger->debug("Selecting bookmark by ID = " . $id);

        $mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);

        if ($mysqli->connect_errno)
		{
			$logger->error($mysqli->connect_error);
		}
		else
        {
            $mysqli->set_charset("utf8");
            $ergebnis = $mysqli->query("SELECT *
                                        FROM Bookmark
                                        WHERE Id = " . $id . ";");
            if ($mysqli->errno)
            {
				$logger->error($mysqli->mysql_error());
			}
			else
            {
                $bookmark = $this->ConvertToObject($ergebnis->fetch_assoc());
                $mysqli->close();

                return $bookmark;
            }
        }

        $mysqli->close();

        return null;
	}
	
    protected function SelectByUserId($userId)
    {
        global $logger;
        $logger->debug("Selecting bookmarks by UserID = " . $userId);

        $mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);

        if ($mysqli->connect_errno)        
		{
			$logger->error($mysqli->connect_error);
		}
		else
        {
            $mysqli->set_charset("utf8");
            $ergebnis = $mysqli->query("SELECT *
                                        FROM Bookmark
                                        WHERE User_Id = " . $userId . ";");
            if ($mysqli->errno)
            {
				$logger->error($mysqli->mysql_error());
			}
			else
            {	
				$bookmarks = array();
							
				while ($dataRow = $ergebnis->fetch_assoc())
				{
					array_push($bookmarks, $this->ConvertToObject($dataRow));
				}
				
                $mysqli->close();

                return $bookmarks;
            }
        }

        $mysqli->close();

        return array();
	}
    #endregion
    
    #region insert
    protected function Insert($bookmark)
    {
        global $logger;
        $logger->debug("Inserting bookmark '".$bookmark->GetTitle()."'");
        
		$title = $bookmark->GetTitle();
		$url = $bookmark->GetUrl();
		$userId = $bookmark->GetUser()->GetId();
			
		$mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);
		
		if ($mysqli->connect_errno)
		{
			$logger->error($mysqli->connect_error);
		}
		else
		{
			$mysqli->set_charset("utf8");
			$ergebnis = $mysqli->query("INSERT INTO Bookamrk(Title, Url, User_Id)
										VALUES('".$title."', '".$url."', ".$userId.");");
		}
		$mysqli->close();
	}
    #endregion
    
    #region update
    protected function Update($bookmark)
    {
        global $logger;
        $logger->debug("Updating bookmark '".$bookmark->GetTitle()."'");
        
        $id = $bookmark->GetId();
		$title = $bookmark->GetTitle();
		$url = $bookmark->GetUrl();
		$userId = $bookmark->GetUser()->GetId();
			
		$mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);
		
		if ($mysqli->connect_errno)
		{
			$logger->error($mysqli->connect_error);
		}
		else
		{
			$mysqli->set_charset("utf8");
			$ergebnis = $mysqli->query("UPDATE User
										SET Title='".$title."',
											Url='".$url."',
											User_Id=".$userId.",
										WHERE Id=".$id.";");
		}
		$mysqli->close();
	}
    #endregion
    
    #region delete
    public function Delete($bookmark)
    {
        global $logger;
        $logger->debug("Deleting bookmark '".$user->GetTitle()."'");
        
        $id = $bookmark->GetId();
			
		$mysqli = new mysqli(MYSQL_HOST, MYSQL_BENUTZER, MYSQL_KENNWORT, MYSQL_DATENBANK);
		
		if ($mysqli->connect_errno)
		{
			$logger->error($mysqli->connect_error);
		}
		else
		{
			$mysqli->set_charset("utf8");
			$ergebnis = $mysqli->query("DELETE Bookmark										
										WHERE Id=".$id.";");
		}
		$mysqli->close();
	}
    #endregion
    
    #region convert	
    protected function ConvertToObject($dataRow)
    {
        global $logger;
        $logger->debug("Converting data row to bookmark");
		$bookmark = $this->Create(intval($dataRow["Id"]));
		$bookmark->SetTitle($dataRow["Title"]);
		$bookmark->SetUrl($dataRow["Url"]);
		$userFactory = new UserFactory();
		$bookmark->SetUser($userFactory->GetById(intval($dataRow["User_Id"])));
		
		return $bookmark;
	}

    public function ConvertToAssocArray($bookmark)
    {
        global $logger;
        
		if ($bookmark == null)
		{
			$logger->warn("Bookmark to be converted to associativ array is null");
			
			return null;
		}
		
        $logger->debug("Converting bookmark '" . $bookmark->GetTitle() . "' to associativ array");	
        $assocArray = array();
        $assocArray["Id"] = $bookmark->GetId();
        $assocArray["Title"] = $bookmark->GetTitle();
        $assocArray["Url"] = $bookmark->GetUrl();        	
		$userFactory = new UserFactory();
		$assocArray["User"] = $userFactory->ConvertToAssocArray($bookmark->GetUser());

        return $assocArray;
    }
    #endregion
    #endregion
}

?>
