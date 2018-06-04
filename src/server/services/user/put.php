<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once("./../../models/user.php");
require_once("./../../factories/userFactory.php");

$userJSON = $_POST;
$user = new User();

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

    $user->SetName($userJSON["Name"]);
    $user->SetEmail($userJSON["Email"]);

    if ($userJSON["Password"] == $userJSON["PasswordConfirmation"])
    {
        $user->SetPassword($userJSON["Password"]);
    }

    $userFactory = new UserFactory();
    $userFactory->Set($user);

    $user = $userFactory->GetByName($user->GetName());
}

$userAssocArray = $userFactory->ConvertToAssocArray($user);
 
echo json_encode($userAssocArray);
