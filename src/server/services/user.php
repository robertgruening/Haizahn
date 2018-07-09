<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("./../models/user.php"); 
require_once("./../factories/userFactory.php");
require_once("./../userstories/userManagement/createUser.php");

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
    

    $createUser = new createUser();

    $createUser->setName($userJSON["Name"]);
    $createUser->setEmail($userJSON["Email"]);
    $createUser->setPassword($userJSON["Password"]);
    $createUser->setPasswordConfirmation($userJSON["PasswordConfirmation"]);
    
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
        $id = intval($_GET["Id"]);		
        $userFactory = new UserFactory();		
        echo json_encode($userFactory->ConvertToAssocArray($userFactory->GetById($id)));
    }
    else
    {
        http_response_code(500);
        echo json_encode("Id not set");
    }
}

