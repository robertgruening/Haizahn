<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("./../models/bookmark.php"); 
require_once("./../factories/BookmarkFactory.php");
require_once("./../userstories/bookmarkManagement/createBookmark.php");
require_once("./../userstories/bookmarkManagement/loadBookmark.php");
require_once("./../userstories/bookmarkManagement/loadBookmarks.php");
require_once("./../userstories/bookmarkManagement/deleteBookmark.php");

if ($_SERVER["REQUEST_METHOD"] == "PUT" ||
    $_SERVER["REQUEST_METHOD"] == "POST")
{
    Save();
}
elseif($_SERVER["REQUEST_METHOD"] == "DELETE")
{
    //Delete();
    http_response_code(500);
    echo json_encode("not implemented");
}
else
{
    Get();
}

function Save()
{ 
 
    parse_str(file_get_contents("php://input"),$_PUT); 
    $userJSON = $_PUT;
    

    $createBookmark = new createBookmark();

    $createBookmark->setTitle($userJSON["Name"]);
    $createBookmark->setUrl($userJSON["Email"]);
    $createBookmark->setTags($userJSON["Password"]);
    $createBookmark->setUser($userJSON["PasswordConfirmation"]);
    
    if($createUser->run())
    { 
        echo json_encode($createUser->getUser()); 
    }
    else
    {
        http_response_code(500);
        echo json_encode($createUser->getMessages()); 
    }
     

    /*
    if (isset($_GET["Id"])) {
        //Bestehenden ändern

        $user->SetName($userJSON["Name"]);
        //$user->SetPassword($_POST["Password"]);
        $user->SetEmail($userJSON["Email"]);
        $userFactory = new UserFactory();
        $userFactory->Set($user);
    } 
    else */
        {
        //Neu anlegen
        //file_get_contents('php://input');

    //  $user->SetName($userJSON["Name"]);
    //  $user->SetEmail($userJSON["Email"]);

    //  if ($userJSON["Password"] == $userJSON["PasswordConfirmation"])
    //  {
    //      $user->SetPassword($userJSON["Password"]);
    //  }

    //  $userFactory = new UserFactory();
    // 
    //  try
    //  {
    //      $userFactory->Set($user);
    //  }
    //  catch (Exception $e)
    //  { 
    //      http_response_code(500);
    //      echo json_encode($e->getMessage()); 
    //      return;
    //  }

    //  $user = $userFactory->GetByName($user->GetName());
    }

   //$userAssocArray = $userFactory->ConvertToAssocArray($user);
    
   // echo json_encode($userAssocArray);
}


function Get()
{
    if (isset($_GET["Id"]))
    {		
        $loadUser = new loadUser();

        $loadUser->setId($_GET["Id"]);
         
        if ($loadUser->run())
        { 
            echo json_encode($loadUser->getUser()); 
        }
        else
        {
            http_response_code(500);
            echo json_encode($loadUser->getMessages()); 
        }
    }
    else
    {
        $loadUsers = new loadUsers();

        if ($loadUsers->run())
        { 
            echo json_encode($loadUsers->getUsers()); 
        }
        else
        {
            http_response_code(500);
            echo json_encode($loadUsers->getMessages()); 
        }
    } 
} 

function Delete()
{ 
    $loadUser = new loadUser();
    if (isset($_GET["Id"]))
    {
        $loadUser->setId(intval($_GET["Id"]));
    }
    if ($loadUser->run())
    {
        $user = $loadUser->getUser();
        
        $deleteUser = new DeleteUser();
        $deleteUser->setUser($user);
        if ($deleteUser->run())
        {
            echo json_encode("User (".$user->getId().") ist gelöscht.");
        }
        else
        {
            http_response_code(500);
            echo json_encode($deleteUser->getMessages());
        }
    }
    else
    {
        http_response_code(500);
        echo json_encode($loadUser->getMessages());
    } 
}

